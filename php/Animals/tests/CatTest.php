<?php
declare (strict_types = 1);

namespace MTCodeAssignment\tests;

use PHPUnit\Framework\TestCase;
use MTCodeAssignment\src\Cat;

final class CatTest extends TestCase
{
    public function testSpeakWithoutValue(): void
    {
        $cat = new Cat();
        $this->expectOutputString('meow'.PHP_EOL);
        $cat->speak();
    }

    public function testSpeakWithValue(): void
    {
        $cat = new Cat();
        $sound = 'roaaarrrrrr';
        $this->expectOutputString($sound.PHP_EOL);
        $cat->speak($sound);
    }
}
