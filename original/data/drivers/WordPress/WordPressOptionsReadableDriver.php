<?php

namespace AutomatedEmails\Original\Data\Drivers\Wordpress;

use AutomatedEmails\Original\Data\Drivers\Abilities\ReadableDriver;
use AutomatedEmails\Original\Data\Query\Parameters;

class WordPressOptionsReadableDriver implements ReadableDriver
{
    public function has(Parameters $parameters): bool
    {
        (string) $placeholderForNonExistingOption = '__NULL__';

        return get_option(
            option: $parameters->find(),
            default: $placeholderForNonExistingOption
        ) !== $placeholderForNonExistingOption;
    } 

    public function find(Parameters $parameters): mixed
    {
        return get_option(
            option: $parameters->get()
        );        
    } 
}