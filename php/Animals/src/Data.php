<?php
namespace MTCodeAssignment\src;

class Data
{
    public function __construct($database)
    {
        echo 'Connecting to database' . PHP_EOL;
    }

    public function beginTransaction()
    {
        echo 'Beginning a transaction' . PHP_EOL;
    }

    public function commit()
    {
        echo 'Committing transaction' . PHP_EOL;
    }

    public function rollbacks()
    {
        echo 'Rolling back transaction' . PHP_EOL;
    }

    public function insert($table, $object)
    {
        echo 'Inserting ' . $object->getName() . ' into table ' . $table . PHP_EOL;
    }

    public function prepare($table, $object)
    {
        echo 'Preparing ' . $object->getName() . ' for save insert into table ' . $table . PHP_EOL;
    }
}
