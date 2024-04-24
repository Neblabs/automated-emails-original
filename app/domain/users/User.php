<?php

namespace AutomatedEmails\App\Domain\Users;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Domain\Entity;
use WP_User;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

Class User extends Entity
{
    private $classic;

    public function __construct(WP_User $wp_user)
    {
        $this->classic = $wp_user;
    }

    public function classic() : WP_User
    {
        return $this->classic;
    }

    public function isGuest() : bool
    {
        return $this->classic->ID == 0;
    }

    public function hasAccount() : bool
    {
        return !$this->isGuest();
    }
    
    public function id() : int
    {
        return $this->classic->ID;
    }
    public function email() : StringManager
    {
        return i($this->classic->user_email);
    }

    public function publicName() : StringManager
    {
        return i($this->classic->display_name);
    }

    public function roleIds() : Collection
    {
        return _($this->classic->roles);
    }

    public function getProperty(string $classicPropertyName) /*: mixed*/
    {
        return $this->classic->{$classicPropertyName};
    }
}