<?php

namespace AutomatedEmails\App\Domain\Posts;

use AutomatedEmails\App\Creation\Data\UsersFactory;
use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Model\Abilities\Identifiable;
use AutomatedEmails\Original\Domain\Entity;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use \WP_Post;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Text\i;

Class Post extends Entity implements Identifiable
{
    protected User $author;

    public function __construct(
        protected WP_Post $post, 
        protected GlobalFunctionWrapper $globalFunctionWrapper = new GlobalFunctionWrapper,
        protected UsersFactory $usersFactory = new UsersFactory
    ) {
        $this->author = $usersFactory->create(userId: (integer) $post->post_author);
    }

    public function classic() : WP_Post
    {
        return $this->post;
    }

    public function id() : int
    {
        return $this->post->ID;
    }

    public function author() : User
    {
        return $this->author;
    }

    public function type() : StringManager
    {
        return i($this->classic()->post_type);
    }

    public function title() : StringManager
    {
        return i($this->globalFunctionWrapper->get_the_title($this->classic()));
    }

    public function titleRaw() : StringManager
    {
        return i($this->classic()->post_title);
    }

    public function content() : StringManager
    {
        return i($this->globalFunctionWrapper->apply_filters(
            'the_content', 
            $this->classic()->post_content
        ));
    }

    public function contentRaw() : StringManager
    {
        return i($this->classic()->post_content);
    }

    public function url() : StringManager
    {
        return i($this->globalFunctionWrapper->get_permalink(post: $this->classic()));
    }
    
    public function status() : StringManager
    {
        return i($this->globalFunctionWrapper->get_post_status($this->post) ?: '');
    }

    public function categories() : Collection
    {
        return _();
    }

    public function categoryIds() : Collection
    {
        return _(
            $this->globalFunctionWrapper->wp_get_post_categories($this->id(), args: a(
                fields: 'ids'
            ))
        );
    }
    
    /**
     * Always returns true by default. 
     * 
     * You have to pass a WP_Post with a property 'isFake' set to true
     */
    public function isReal() : bool
    {
        return !$this->classic()->isFake;
    }
}