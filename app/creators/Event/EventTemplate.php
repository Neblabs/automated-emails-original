<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Events\PostStatusChangeEventComponent;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostsData;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\App\Domain\Events\SupportedData\Posts;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetPosts;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Domain\Posts\Validators\StatusHasChanged;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Events\Wordpress\Request\Action;
use AutomatedEmails\Original\Events\Wordpress\Request\Hook;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;
use WP_Post;
use stdClass;

use function AutomatedEmails\Original\Utilities\Collection\{_, a, o};

Class {$className} extends Event //implements Posts
{
    use GetPosts;

    protected PostData \$posts;
    
    protected function hook() : Hook
    {
        return new Action(name: '');
    }

    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
        ));
    }

    public function validator(stdClass \$statuses) : Validator
    {
        return new PassingValidator;
    }

    public function component(): Identifiable
    {
        return new {$componentName};  
    } 
}

TEMPLATE;
