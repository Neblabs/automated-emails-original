<?php

namespace AutomatedEmails\Original\Data\Drivers\SQL;

use AutomatedEmails\Original\Data\Drivers\Abilities\ReadableDriver;
use AutomatedEmails\Original\Data\Drivers\Abilities\SQLReadableDriver;
use AutomatedEmails\Original\Data\Query\Parameters;
use PDO;

class PDODatabaseDriver implements ReadableDriver, SQLReadableDriver
{
    public function __construct(
        protected PDO $pdo      
    ) {}

    public function has(Parameters $parameters): bool
    {
        (object) $statement = $this->getStatement($parameters);

        return $statement->execute($instruction->getParameters());
    } 
    
    public function find(Parameters $parameters): mixed
    {
        (object) $statement = $this->getStatement($parameters);
        /**
        (object) $statement = $this->pdo->prepare($instruction->getStatement());
        */
        return $statement->fetchAll();
    } 

    protected function getStatement(Parameters $parameters)
    {
        return $parameters->getStatement($this->pdo);
    }
}