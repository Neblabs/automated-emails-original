<?php

namespace AutomatedEmails\App\Domain\Events\Builtin\PostUpdated;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\OldPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\UpdatedPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\LoggedInUserDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\PostAuthorDataComponent;
use AutomatedEmails\App\Components\Events\BuiltIn\PostUpdated\PostUpdatedComponent;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostsData;
use AutomatedEmails\App\Domain\Events\SupportedData\Posts;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetPosts;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Data\User\UsersData;
use AutomatedEmails\App\Domain\Events\SupportedData\Users;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetUsers;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Events\Wordpress\Request\Action;
use AutomatedEmails\Original\Events\Wordpress\Request\Hook;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;
use WP_Post;

use function AutomatedEmails\Original\Utilities\Collection\{_, a, o};

Class PostUpdated extends Event implements Posts, Users
{
	use GetPosts;
	use GetUsers;

    protected function hook() : Hook
    {
        return new Action(name: 'post_updated');
    }

    public function createEventArguments($post_ID, WP_Post $post_after, WP_Post $post_before) : EventArguments
    {
        return new EventArguments(_(
            old: new Post($post_before),
            new: new Post($post_after)
        ));
    }

    public function validator(Post $new) : Validator
    {
        return new Validators([
            new ValidWhen($new->status()->isNotEither(['new', 'inherit', 'auto-draft'])),
        ]);
    }
    
    protected function posts(Post $new, Post $old) : PostsData
    {
        return new PostsData([
            new PostData(id: UpdatedPostDataComponent::ID, entity: $new),
            new PostData(id: OldPostDataComponent::ID, entity: $old)
        ]);
    }

    protected function users(Post $new) : UsersData
    {
        return new UsersData([
            new UserData(id: PostAuthorDataComponent::ID, entity: $new->author()),
            new UserData(id: LoggedInUserDataComponent::ID, entity: new User(wp_get_current_user()))
        ]);
    }

    public function component(): Identifiable
    {
        return new PostUpdatedComponent;  
    } 
}
