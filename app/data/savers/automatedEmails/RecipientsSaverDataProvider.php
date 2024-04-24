<?php

namespace AutomatedEmails\App\Data\Savers\Automatedemails;

use AutomatedEmails\App\Data\Finders\Recipients\RecipientStructure;
use AutomatedEmails\App\Data\Savers\WordPressPostMetaSaverDataProvider;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\_;

class RecipientsSaverDataProvider extends WordPressPostMetaSaverDataProvider
{
    public function __construct(
        protected RecipientStructure $recipientStructure
    ) {}
    
    public function inputKey(): string
    {
        return Env::idLowerCase().'-recipients';
    } 

    public function outputKey(): string
    {
        return $this->recipientStructure->fields()->id()->id();
    } 

    public function canBeSaved(StringManager $dataToSave): Validator
    {
        return new PassingValidator;
    } 

    public function dataToSave(StringManager $dataToSave): Collection|string|int|float
    {
        return _(json_decode(wp_unslash($dataToSave->get())))->map(
            fn(string $email) => _(email: $email)->asJson()->get()
        );       
    } 
}