<?php

namespace AutomatedEmails\Original\Data\Query;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Schema\Fields\ID;
use AutomatedEmails\Original\Data\Schema\Structure;
use Exception;

use function AutomatedEmails\Original\Utilities\Collection\_;

abstract class Parameters
{
    abstract public function query() : mixed;
    abstract public function setInternalRelationship(ID $idField) : void;
    abstract public function reset() : void; 
    
    public function __construct(
        protected Structure $structure
    ) {}

    public function beforePassingToDriver() : void
    {
        if ($this->structure->fields()->hasId()) {
            $this->setInternalRelationship($this->structure->fields()->id());
        }
    }

    public function structure() : Structure
    {
        return $this->structure;
    }
}