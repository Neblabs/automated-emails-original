<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Domain\Users\User;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use WP_User;

class UsersFactory
{
    public function __construct(
        protected GlobalFunctionWrapper $globalFunctionWrapper = new GlobalFunctionWrapper
    ) {}
    
    public function create(int $userId) : User
    {
        return new User(
            $this->globalFunctionWrapper->get_user_by(field: 'id', value: $userId) ?: new WP_User(id: $userId)
        );
    }
}