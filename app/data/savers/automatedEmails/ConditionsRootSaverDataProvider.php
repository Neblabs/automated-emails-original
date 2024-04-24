<?php

namespace AutomatedEmails\App\Data\Savers\Automatedemails;

use AutomatedEmails\App\Data\Finders\ConditionsRoot\ConditionsRootStructure;
use AutomatedEmails\App\Data\Finders\Events\EventStructure;
use AutomatedEmails\App\Data\Savers\WordPressPostMetaSaverDataProvider;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

class ConditionsRootSaverDataProvider extends WordPressPostMetaSaverDataProvider
{
    public function __construct(
        protected ConditionsRootStructure $conditionsRootStructure
    ) {}
    
    public function inputKey(): string
    {
        return Env::idLowerCase().'-conditions_root';
    } 

    public function outputKey(): string
    {
        return $this->conditionsRootStructure->fields()->id()->id();
    } 

    public function canBeSaved(StringManager $dataToSave): Validator
    {
        // obly if valid json
        return new PassingValidator;
    } 

    public function dataToSave(StringManager $dataToSave): Collection|string|int|float
    {
        return wp_unslash($dataToSave->get());       
    } 
}