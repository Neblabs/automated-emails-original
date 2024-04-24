<?php

namespace AutomatedEmails\App\Components\Passable\Builtin;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Domain\Conditions\HasNonePassable;

use function AutomatedEmails\Original\Utilities\Text\__;

class HasNonePassableComponent implements Identifiable, Typeable, Nameable
{
    public function identifier(): string
    {
        return 'none';
    } 

    public function type(): string
    {
        return HasNonePassable::class;
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('None');
    } 
}