<?php

namespace AutomatedEmails\App\Data\Finders\Recipients;

use AutomatedEmails\Original\Data\Schema\Fields;
use AutomatedEmails\Original\Data\Schema\Fields\Field;
use AutomatedEmails\Original\Data\Schema\Fields\ID;
use AutomatedEmails\Original\Data\Schema\Structure;
use AutomatedEmails\Original\Environment\Env;
use function AutomatedEmails\Original\Utilities\Collection\_;

class RecipientStructure extends Structure
{
    public function name(): string
    {
        global $wpdb;

        return $wpdb->postmeta;
    } 

    public function fields(): Fields
    {
        return new Fields(_(
            new Field(name: 'meta_id', alias: 'id'),
            new Field(name: 'post_id', alias: 'postId'),
            new ID(
                new Field(name: 'meta_key', alias: 'key'),
                name: Env::getwithShortPrefix('recipient'),
            ),
            new Field(name: 'meta_value', alias: 'value')
        ));
    } 
}