<?php

namespace AutomatedEmails\App\Components\Builtin;

use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\Conditions\ConditionComponents;
use AutomatedEmails\App\Components\Data\DataComponents;
use AutomatedEmails\App\Components\Data\DataTypeComponents;
use AutomatedEmails\App\Components\Events\EventComponents;
use AutomatedEmails\Original\Collections\Collection;

use function AutomatedEmails\Original\Utilities\Collection\_;

class NonImplementedComponents implements 
    MultipleComponentsProvider,
    EventComponents,
    ConditionComponents,
    DataComponents,
    DataTypeComponents
{
    public function events(): Collection
    {
        return _(

        );    
    } 

    public function conditions(): Collection
    {
        return _(

        );    
    } 

    public function dataTypes(): Collection
    {
        return _(

        );    
    } 

    public function data(): Collection
    {
        return _(

        );       
    } 
}