<?php
declare (strict_types = 1);

namespace MTCodeAssignment\tests;

use PHPUnit\Framework\TestCase;
use MTCodeAssignment\src\Dog;

final class DogTest extends TestCase
{
    public function testSpeakWithoutValue(): void
    {
        $cat = new Dog();
        $this->expectOutputString('woof'.PHP_EOL);
        $cat->speak();
    }

    public function testSpeakWithValue(): void
    {
        $cat = new Dog();
        $sound = 'woofwoof';
        $this->expectOutputString($sound.PHP_EOL);
        $cat->speak($sound);
    }
}
