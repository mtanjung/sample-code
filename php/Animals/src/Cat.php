<?php
namespace MTCodeAssignment\src;

use MTCodeAssignment\src\Animal;

/**
 * This class generates Cat object extends from animal
 *
 * @author Michael Tanjung
 */
class Cat extends Animal
{
    /**
     * Print out $sound. If $sound not provided, the sound will be 'meow'
     *
     * @param string $sound
     * @return void
     */
    public function speak($sound = 'meow')
    {
        parent::speak($sound);
    }
}
