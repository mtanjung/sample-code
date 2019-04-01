<?php
namespace MTCodeAssignment\src;

require __DIR__ . '/../vendor/autoload.php';

use MTCodeAssignment\src\Cat;
use MTCodeAssignment\src\Data;

class PetShop
{
    public function __construct()
    {
        $this->connection = new Data('database');
    }

    public function saveTest()
    {
        $cat = new Cat('Kitty');
        $this->insertToPetShopInventory($cat);

        $dog = new Cat('Doggy');
        $this->insertToPetShopInventory($dog);
    }

    /**
     * Create three nameless cats and dogs insert them to the database.
     * Make the objects persist, so they can be access outside this function
     *
     * @return void
     */
    public function savePetShop()
    {
        for ($i=1; $i<=3; $i++) {
            $newCat = 'newCat'.$i;
            $this->$newCat = new Cat();
            $this->insertToPetShopInventory($this->$newCat);

            $newDog = 'newDog'.$i;
            $this->$newDog = new Dog();
            $this->insertToPetShopInventory($this->$newDog);
        }
    }

    public function logStats($message)
    {
        echo $message . PHP_EOL;
    }

    private function insertToPetShopInventory($animal)
    {
        try {
            $this->connection->beginTransaction();
            // @todo Need to use prepared statements and parameterized queries
            // to avoid SQL injection
            // $this->connection->prepare('pet_shop_inventory', $animal);
            $this->connection->insert('pet_shop_inventory', $animal);
            $this->connection->commit();
            // throw new \PDOException("Whoops this is just a dummy connection");
            $this->logStats('Success! '.$animal->getName() . ' inserted to our db');
        } catch (\PDOException $e) {
            $this->connection->rollbacks();
            $this->logStats('Error' . $e->getMessage());
        }
    }
}

$newPetShop = new PetShop();
$newPetShop->saveTest();
$newPetShop->savePetShop();
$newPetShop->logStats('Test logStats');

$newPetShop->newCat1->speak('test');
for ($i=1; $i<=3; $i++) {
    $newCat = 'newCat'.$i;
    echo 'Nameless ' . substr(strrchr(get_class($newPetShop->$newCat), '\\'), 1) . ' Say ';
    $newPetShop->$newCat->speak('Meow-'.$i);
}

for ($i=1; $i<=3; $i++) {
    $newDog = 'newDog'.$i;
    echo 'Nameless ' . substr(strrchr(get_class($newPetShop->$newDog), '\\'), 1)  . ' Say ';
    $newPetShop->$newDog->speak('Woof-'.$i);
}
