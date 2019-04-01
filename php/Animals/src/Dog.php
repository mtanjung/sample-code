<?php
namespace MTCodeAssignment\src;

use MTCodeAssignment\src\Animal;

/**
 * This class generates Dog object extends from animal
 *
 * @author Michael Tanjung
 */
class Dog extends Animal
{
    /**
     * Print out $sound. If $sound not provided, the sound will be 'woof'
     *
     * @param string $sound
     * @return void
     */
    public function speak($sound = 'woof')
    {
        parent::speak($sound);
    }
}
