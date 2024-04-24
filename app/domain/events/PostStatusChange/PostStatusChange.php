<?php

namespace AutomatedEmails\App\Domain\Events\PostStatusChange;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Data\Builtin\Post\Data\UpdatedPostDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\LoggedInUserDataComponent;
use AutomatedEmails\App\Components\Data\Builtin\User\Data\PostAuthorDataComponent;
use AutomatedEmails\App\Components\Events\Builtin\PostStatusChangeEventComponent;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostsData;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Data\User\UsersData;
use AutomatedEmails\App\Domain\Events\Event;
use AutomatedEmails\App\Domain\Events\SupportedData\Posts;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetPosts;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetUsers;
use AutomatedEmails\App\Domain\Events\SupportedData\Users;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Domain\Posts\Validators\StatusHasChanged;
use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Events\Wordpress\Request\Action;
use AutomatedEmails\Original\Events\Wordpress\Request\Hook;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;
use WP_Post;
use stdClass;

use function AutomatedEmails\Original\Utilities\Collection\{_, a, o};
use function AutomatedEmails\Original\Utilities\Text\i;

//tests:
//maybe test that this is not executed if the new status is draft
//
Class PostStatusChange extends Event implements Posts, Users
{
    use GetPosts;
    use GetUsers; 

    protected PostData $posts;
    
    protected function hook() : Hook
    {
        return new Action(name: 'transition_post_status');
    }

    public function createEventArguments(string $new_status, string $old_status, WP_Post $post) : EventArguments
    {
        return new EventArguments(_(
            statuses: o(
                old: $old_status,
                new: $new_status
            ),
            post: new Post($post)
        ));
    }

    public function validator(stdClass $statuses) : Validator
    {
        return new Validators([
            new ValidWhen(i($statuses->new)->isNotEither(['new', 'inherit', 'auto-draft'])),
            new StatusHasChanged(
                old: $statuses->old,
                new: $statuses->new
            )
        ]);
    }

    protected function posts(Post $post) : PostsData
    {
        return new PostsData([
            new PostData(id: UpdatedPostDataComponent::ID, entity: $post)
        ]);
    }

    protected function users(Post $post) : UsersData
    {
        return new UsersData([
            new UserData(id: PostAuthorDataComponent::ID, entity: $post->author()),
            new UserData(id: LoggedInUserDataComponent::ID, entity: new User(wp_get_current_user()))
        ]);
    }

    public function component(): Identifiable
    {
        return new PostStatusChangeEventComponent;  
    } 
}