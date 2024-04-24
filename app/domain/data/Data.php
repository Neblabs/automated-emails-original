<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Creation\DataValuesFactory;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\App\Domain\Data\DataValue;
use AutomatedEmails\App\Domain\Data\DataValues;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entity;
use AutomatedEmails\Original\Validation\Validators\CollectionHasKey;
use Exception;
use InvalidArgumentException;
use ReflectionClass;
use function AutomatedEmails\Original\Utilities\validate;

Abstract Class Data extends Entity
{
    public const NULL_OBJECT_ID = '__NULL_OBJECT__';
    /**
     * This id is the context of post, like a new post, or an updated post, etc
     */
    protected string $id;
    protected DataValues $values;

    /**
     * Sets the entity to use. The entity is meant to be the main data source that
     * the DataValues use.
     */
    abstract protected function setEntity(mixed $entity): void;
    abstract public function entity() : mixed;
    abstract public function type() : DataType;
    abstract protected function valuesFactory() : DataValuesFactory;

    public function __construct(string $id, mixed $entity)
    {
        $this->id = $id;
        $this->setEntity($entity);
        $this->values = $this->valuesFactory()->create();
    }

    public function id() : string
    {
        return $this->id;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function value(string $id) : DataValue
    {
        return $this->values->value($id);
    }

    public function availableForms() : Collection
    {
        return $this->type()->supportedForms(); 
    }

    public function isNull() : bool
    {
        return $this->id() === static::NULL_OBJECT_ID;
    }
}