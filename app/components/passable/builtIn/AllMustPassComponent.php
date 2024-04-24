<?php

namespace AutomatedEmails\App\Components\Passable\Builtin;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Domain\Conditions\AllMustPass;

use function AutomatedEmails\Original\Utilities\Text\__;

class AllMustPassComponent implements Identifiable, Nameable, Typeable
{
    public function identifier(): string
    {
        return 'all';
    } 

    public function type(): string
    {
        return AllMustPass::class;
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('AND');
    } 
}