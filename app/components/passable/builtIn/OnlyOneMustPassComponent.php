<?php

namespace AutomatedEmails\App\Components\Passable\Builtin;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Domain\Conditions\AllMustPass;
use AutomatedEmails\App\Domain\Conditions\OnlyOneMustPass;

use function AutomatedEmails\Original\Utilities\Text\__;

class OnlyOneMustPassComponent implements Identifiable, Nameable, Typeable
{
    public function identifier(): string
    {
        return 'one';
    } 

    public function type(): string
    {
        return OnlyOneMustPass::class;
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('OR');
    } 
}