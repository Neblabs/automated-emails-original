<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Components\Abilities\ConditionComponent;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Creation\Entities\Abilities\ConditionTemplateFactory;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Construction\Abilities\OverloadableFactory;

/*
SO HERE'S WHAT WE GONNA DO:

-IF THE TYPE CANT BVE FOUND, WE'LL RAISE AN EXCEPTION
-THE AUTOMATED EMAILS FACTORY SHOULD CATCH ANY ECXCEPTION **INDIVIDUALLY**
 SO THAT OF YOU HAVE MORE THEN ONE EMAIL AND ONLY ONE FALS BUT THEOTHERS
 ARE VALID, LET THEM KEEP EXECUTING
 ALSO WE NEED ANOTHER EXCEPTION ON TOP OF THAT SO THAT OF ANYTHING FAILS AT RUNTIME FROM US, THE PROGRAM CAN STILL RUN, THIS IS THE LOWEST LEVEL
*/
class FromRegisteredComponentsConditionTemplateFactory implements 
    OverloadableFactory, 
    ConditionTemplateFactory
{
    public function __construct(
        protected Components $conditionComponents
    ) {}
    
    /** @param string $value */
    public function canCreate(mixed $value): bool
    {
        return $this->conditionComponents->has(id: $value);
    } 

    public function create(string $type): TemplateDefinition
    {
        /** @var ConditionComponent */
        (object) $conditionComponent = $this->conditionComponents->withId(id: $type);

        return $conditionComponent->options()
                                  ->options();
    } 
}