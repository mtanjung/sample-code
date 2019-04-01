<?php
namespace MTCodeAssignment\src;

require __DIR__ . '/../vendor/autoload.php';

use MTCodeAssignment\src\Cat;
use MTCodeAssignment\src\Dog;
use MTCodeAssignment\src\Data;

$cat1 = new Cat();
echo 'Name is currently ' . $cat1->getName() . PHP_EOL;

$cat1->setName('Garfield');
echo 'Name has been changed to ' . $cat1->getName() . PHP_EOL;

$data =  new Data('database');
$data->insert('Cat', $cat1);

// Additional functionality, folowing the pattern above.
$cat1InitialName = $cat1->getName();
$cat1InitialAge = $cat1->getAge();
echo $cat1InitialName . ' current age is ' . $cat1InitialAge . PHP_EOL;

$cat1->setAge(10);
echo $cat1InitialName. ' age has been changed from '. $cat1InitialAge .' to ' . $cat1->getAge() . PHP_EOL;

$cat1->setName('Tigger');
echo $cat1InitialName . ' new name is ' . $cat1->getName() . PHP_EOL;

if ($cat1->getFavoriteFood() === null) {
    echo $cat1->getName() . ' does not have favorite food yet ' . PHP_EOL;
}

$cat1->setFavoriteFood('Fish');
echo $cat1->getName() . ' favorite food is ' . $cat1->getFavoriteFood() . PHP_EOL;

try {
    $data->beginTransaction();
    // @todo Need to use prepared statements and parameterized queries
    // to avoid SQL injection
    // $this->connection->prepare('pet_shop_inventory', $animal);
    $data->insert('pet_shop_inventory', $cat1);
    $data->commit();
    //throw new \PDOException("Whoops this is just a dummy connection");
    echo 'Yay ' . $cat1->getName() . ' is now in our database :)' . PHP_EOL;
} catch (\PDOException $e) {
    $data->rollbacks();
    echo 'Something went wrong ' . $cat1->getName() . ' did not get saved into our database :(' . PHP_EOL;
}

$cat2 = new Cat('Miumiu');
echo 'New Cat arrived! her name is ' . $cat2->getName() . PHP_EOL;
echo 'Her age is ' . $cat2->getAge() . PHP_EOL;

$numberOfSpeak = 5;
for ($i=1; $i<=$numberOfSpeak; $i++) {
    $cat2->speak();
}

echo $cat2->getName(). ' speaks! Exactly ' . $numberOfSpeak . ' times!' . PHP_EOL;
echo 'Everytime she speaks 5 times, she will get older by 1. She is now ' . $cat2->getAge() . PHP_EOL;

$cat2PreviousName = $cat2->getName();
$cat2->setName('Princess');
echo $cat2PreviousName . ' changed her name to ' . $cat2->getName()  . '!' . PHP_EOL;
$cat2PreviousName = $cat2->getName();

$namesToTry = ['Lion', 'Sharky', 'Kitty', 'Coco Chanel Divalicious', 'Empress Snowcone Kittlesworth'];
foreach ($namesToTry as $name) {
    $cat2->setName($name);
}

echo $cat2PreviousName . ' changed her name ' . count($namesToTry). ' times more!' . PHP_EOL;
echo 'Names she tried: '. implode(', ', $namesToTry) . PHP_EOL;
echo 'Finally settled with "' . $cat2->getName() . '"'. PHP_EOL;
echo 'In total she changed her name ' . count($cat2->getNames()) . ' times!'. PHP_EOL;
echo 'Those names are ' . implode(', ', $cat2->getNames()) . PHP_EOL;
echo 'Averange length of those names is ' . $cat2->getAverageNameLength() . ' (rounded, spaces included)' . PHP_EOL;
