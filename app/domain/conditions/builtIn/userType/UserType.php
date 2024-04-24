<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\UserType;

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class UserType extends Condition implements SettableData
{
    protected User $user;

    static public function id(): string
    {
        return 'UserType';
    }  

    public function __construct(
        protected StringManager $type
    ) {}

    /** @param UserData $data */
    public function setData(Data $data) : void
    {
        $this->user = $data->entity();
    }

    public function canExecute() : Validator
    {
        return new PassingValidator;
    }

    protected function execute(): Validator
    {
        $isTrue = match($this->type->get()) {
            'account' => $this->user->hasAccount(),
            'guest' => $this->user->isGuest()
        };
        
        return new ValidWhen($isTrue);
    } 
}
