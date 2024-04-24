<?php

namespace AutomatedEmails\Original\Events;

use AutomatedEmails\Original\Abilities\DuckInterface;
use AutomatedEmails\Original\Abilities\Methods;

#[DuckInterface]
#[Methods([
    'createEventArguments', 
    'validator', 
    'execute'
])]
/**
 * @method mixed execute()
 */
Interface Subscriber
{
    public function priority() : int;
    /**
     * THEY ALL NEED BE PUBLIC!
     */
    /* public function createEventArguments([...]) : EventArguments; */
    /* public function validator([...]) : Validator; */
    /* public function execute([...]) : void */
}