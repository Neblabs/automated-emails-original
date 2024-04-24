<?php

namespace AutomatedEmails\App\Data\Finders\Automatedemails;

use AutomatedEmails\Original\Data\Schema\Fields;
use AutomatedEmails\Original\Data\Schema\Fields\Field;
use AutomatedEmails\Original\Data\Schema\Fields\ID;
use AutomatedEmails\Original\Data\Schema\Structure;
use AutomatedEmails\Original\Environment\Env;

use function AutomatedEmails\Original\Utilities\Collection\_;

class AutomatedEmailsStructure extends Structure
{
    public function name(): string
    {
        global $wpdb;

        return $wpdb->posts;
    } 

    public function fields(): Fields
    {
        return new Fields(_(
            new Field(name: 'ID', alias: 'id'),
            new Field(name: 'post_title', alias: 'subject'),
            new Field(name: 'post_content', alias: 'body'),
            new ID(
                new Field(name: 'post_type', alias: 'type'),
                name: 'automatedemail'
            )
        ));
    } 
}