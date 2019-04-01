<?php
declare (strict_types = 1);

namespace MTCodeAssignment\tests;

use PHPUnit\Framework\TestCase;
use MTCodeAssignment\src\Animal;

final class AnimalTest extends TestCase
{
    public function testNewAnimalAgeMustBeRandomBetween5To10(): void
    {
        $animal = new Animal();
        $animalAge = $animal->getAge();
        $this->assertTrue(
            ($animalAge >= 5) && ($animalAge <= 10),
            "Age must be between 5 and 10"
        );
    }

    public function testLoopNewAnimalAgeMustBeRandomBetween5To10(): void
    {
        $numberOfLoops = 10000;
        for ($i = 1; $i <= $numberOfLoops; $i++) {
            $this->testNewAnimalAgeMustBeRandomBetween5To10();
        }
    }

    public function testSpeakWithoutValue(): void
    {
        $animal = new Animal();
        $this->expectOutputString(PHP_EOL);
        $animal->speak();
    }

    public function testSpeakWithValue(): void
    {
        $animal = new Animal();
        $sound = 'Annniimmmaaalll';
        $this->expectOutputString($sound.PHP_EOL);
        $animal->speak($sound);
    }

    /**
     * Test age increment of 1 for every 5 speaks
     */
    public function testSpeakUpdateAge(): void
    {
        $animal = new Animal();
        $speakCounter = 0;
        $animalInitialAge = $animal->getAge();

        for ($i=1; $i<=1000; $i++) {
            // Prevent echo from populating the terminal with ob_
            ob_start();
            $animal->speak();
            ob_end_clean();
  
            $speakCounter++;
            $animalAge = $animal->getAge();

            if ($speakCounter !== 0 && $speakCounter % 5 === 0) {
                $animalInitialAge++;
            }

            //echo 'Speak counter: ' . $speakCounter . ' - ';
            //echo 'Animal age: ' . $animalAge . ' - ';
            //echo 'Target age: ' . $animalInitialAge;

            $this->assertEquals($animalAge, $animalInitialAge);
        }
    }

    /**
     * Test average name length calculation
     */
    public function testAverageNameLength(): void
    {
        $animal = new Animal();
        $animalNames = [];

        for ($i=1; $i<=100; $i++) {
            $testName = str_repeat('test name', $i * rand(1, 10));
            
            $animal->setName($testName);
            $currentAverageNameLength = $animal->getAverageNameLength();

            $animalNames[] = $testName;
            $targetAverageNameLength = round(strlen(implode('', $animalNames)) / $i);

            //echo 'Animal avg length: ' . $currentAverageNameLength. ' vs target: ' . $targetAverageNameLength . PHP_EOL;
            
            $this->assertEquals($currentAverageNameLength, $targetAverageNameLength);
        }
    }
}
