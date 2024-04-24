<?php

namespace AutomatedEmails\Original\Data\Drivers;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Instructions\Instruction;

Class WordPressOptionsAPIDriver extends DatabaseDriver
{
    protected function setConnection() {}

    public function execute(Instruction $instruction)
    {
        return;
    }

    protected function get(Collection $parameters)
    {
        return get_option(
            $parameters->get('name'), 
            $parameters->get('default')
        );
    }

    protected function update(Collection $parameters)
    {
        return update_option(
            $parameters->get('name'), 
            $parameters->get('value')
        );
    }

    protected function delete(Collection $parameters)
    {
        return delete_option($parameters->get('name'));
    }
}