<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Data\User\UserData;
use AutomatedEmails\App\Domain\Data\User\UserDataType;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Domain\Users\User;
use WP_Post;
use WP_User;

class UserDataFactory extends DataFactory
{
    public function __construct(
        protected UserDataType $userDataType
    ) {}

    public function withId(mixed $id): PostData
    {
        (object) $gateway = $this->postDataType->gateway();

        (object) $post = $gateway->withId($id);

        return new PostData(id: $id, entity: $post);
    } 

    public function createNullDataObject() : UserData
    {
        return new UserData(
            id: Data::NULL_OBJECT_ID, 
            entity: new User(new WP_User(id: 0))
        );
    }
}