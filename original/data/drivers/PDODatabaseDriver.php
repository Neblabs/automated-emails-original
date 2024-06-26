<?php

namespace AutomatedEmails\Original\Data\Drivers;

use AutomatedEmails\Original\Data\Instructions\Instruction;
use AutomatedEmails\Original\Data\Schema\DatabaseColumn;
use AutomatedEmails\Original\Data\Schema\DatabaseTable;
use PDO;
use PDOStatement;

Class PDODatabaseDriver extends DatabaseDriver
{
    protected function setConnection()
    {
        $this->pdo = new PDO(
            "mysql:host={$this->credentials->get('host')};dbname={$this->credentials->get('name')}",
            $this->credentials->get('username'), 
            $this->credentials->get('password')
        );
    }

    public function execute(Instruction $instruction)
    {
        (object) $statement = $this->pdo->prepare($instruction->getStatement());

        $result = $statement->execute($instruction->getParameters());

        return $instruction->shouldGet()? $statement->fetchAll() : $result;   
    }

    public function escapeLike($value)
    {
        return $value;
    }
}