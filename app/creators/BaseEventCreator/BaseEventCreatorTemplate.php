<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use {$settings->app->namespace}\App\Components\Abilities\Identifiable;
use {$componentClassName->fullyQualifiedClassName};
{$self->dataTypeImports()}
use {$settings->app->namespace}\App\Domain\Events\Event;
use {$settings->app->namespace}\Original\Events\Wordpress\EventArguments;
use {$settings->app->namespace}\Original\Events\Wordpress\Request\Action;
use {$settings->app->namespace}\Original\Events\Wordpress\Request\Hook;
use {$settings->app->namespace}\Original\Validation\Validator;
use {$settings->app->namespace}\Original\Validation\Validators;

use function AutomatedEmails\Original\Utilities\Collection\{_, a, o};

Class {$className} extends Event {$implements}
{
{$traitImports}

    protected function hook() : Hook
    {
        return new Action(name: '{$actionHook}');
    }

    public function createEventArguments(/*here_the_original_raw_hook_arguments*/) : EventArguments
    {
        return new EventArguments(_(
            //post: new Post(\$post)
        ));
    }

    public function validator(/*can_use_the_clean_arguments_SET_in_createEventArguments*/) : Validator
    {
        return new Validators([
        ]);
    }
    {$self->dataTypeProviderMethodDefinitions()}
    public function component(): Identifiable
    {
        return new {$componentClassName->className};  
    } 
}

TEMPLATE;
