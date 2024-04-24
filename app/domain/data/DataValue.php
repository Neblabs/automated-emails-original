<?php

namespace AutomatedEmails\App\Domain\Data;

use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\Original\Domain\Entity;
use AutomatedEmails\Original\Exceptions\InvalidImplementationException;
use AutomatedEmails\Original\Validation\Validators\NotEmpty;
use function AutomatedEmails\Original\Utilities\validate;

abstract Class DataValue
{
    public const FORM = '';
    public const ID = '';

    /**
     * Gets the actual computed value.
     */
    abstract public function get() : mixed;
    abstract public function data() : Data;

    /**
     * The id of the value, for example, 'title' or 'name'
     */
    public function id() : string
    {
        validate(
            (new NotEmpty(static::ID))->withException(new InvalidImplementationException(static::class .' must implement a public const ID'))
        );

        return static::ID;
    }

    /**
     * The form of the value, like a 'string' or an 'email'.
     * See DataForms for the supported forms.
     */
    public function form() : string
    {
        validate(
            (new NotEmpty(static::FORM))->withException(new InvalidImplementationException(static::class .' must implement a public const FORM'))
        );

        return static::FORM;
    }

    public function is(string $dataForm) : bool
    {
        return $dataForm === $this->form();
    }
}