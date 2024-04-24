<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\UserRole;

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\CollectionHasItems;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class UserRole extends Condition implements SettableData
{
    protected User $user;

    static public function id(): string
    {
        return 'UserRole';
    }  

    public function __construct(
        protected StringManager $permission,
        protected StringManager $quantifier,
        protected Collection $ids
    ) {}

    /** @param UserData $data */
    public function setData(Data $data) : void
    {
        $this->user = $data->entity();
    }

    public function canExecute() : Validator
    {
        return new Validators([
            new ValidWhen($this->ids->haveAny())
        ]);
    }

    protected function execute(): Validator
    {
        return new CollectionHasItems(
            collection: $this->user->roleIds(),
            itemsToCheck: $this->ids,
            permission: $this->permission,
            quantifier: $this->quantifier
        );
    } 
}
