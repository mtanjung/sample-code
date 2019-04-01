<?php
namespace MTCodeAssignment\src;

/**
 * This class generates animal object with several functionality
 *
 * @author Michael Tanjung
 */
class Animal
{
    /**
     * Name of the animal
     *
     * @var string|null
     */
    private $name = null;

    /**
     * Age of the animal
     *
     * @var integer|null
     */
    private $age = null;

    /**
     * Favorite food of the animal
     *
     * @var string|null
     */
    private $favoriteFood = null;

    /**
     * Store an array of animal names
     *
     * @var array
     */
    private $names = [];

    /**
     * Speak counter
     *
     * @var integer
     */
    private $speakCounter = 0;

    /**
     * Stores the average length of names
     *
     * @var integer
     */
    private $averageNameLength = 0;

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name = '')
    {
        // Set inital age to a random number between 5 and 10
        $this->age = rand(5, 10);

        // If $name provided, update several properties
        if ($name !== '') {
            $this->name = $name;

            // Push name to names array
            $this->names[] = $name;

            // Update the average name length
            $this->averageNameLength = strlen($name);
        }
    }

    /**
     * Get name of the animal
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get age of the animal
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Get favorite food of the animal
     *
     * @return string
     */
    public function getFavoriteFood()
    {
        return $this->favoriteFood;
    }

    /**
     * Get Names array for the animal
     *
     * @return array
     */
    public function getNames()
    {
        return $this->names;
    }
    
    /**
     * Get average name length for the animal
     *
     * @return integer
     */
    public function getAverageNameLength()
    {
        return $this->averageNameLength;
    }

    /**
     * Set name of the animal, also push the new name into $names and
     * calculate the average name length of the animal, so when we are pulling the value
     * we don't have to calculate it, just simple return the property.
     *
     * @param string $newName
     * @return void
     */
    public function setName($newName)
    {
        $this->name = $newName;

        $this->names[] = $newName;
        $pastNameCount = count($this->names);
        $countCharactersInNames = strlen(implode('', $this->names));
        $this->averageNameLength = round($countCharactersInNames / $pastNameCount);
    }

    /**
     * Set age of the animal
     *
     * @param integer $newAge
     * @return void
     */
    public function setAge($newAge)
    {
        return $this->age = $newAge;
    }

    /**
     * set favorite food of the animal
     *
     * @param string $newFavoriteFood
     * @return void
     */
    public function setFavoriteFood($newFavoriteFood)
    {
        return $this->favoriteFood = $newFavoriteFood;
    }

    /**
     * Print out $sound. This function will also increase the speak counter
     * and age on every 5 speak increment.
     *
     * @param string $sound
     * @return void
     */
    public function speak($sound = '')
    {
        echo $sound . PHP_EOL;
        $this->speakCounter++;

        if ($this->speakCounter !== 0 && $this->speakCounter % 5 === 0) {
            $this->age++;
        }
    }
}
