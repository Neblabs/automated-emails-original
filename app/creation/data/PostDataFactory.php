<?php

namespace AutomatedEmails\App\Creation\Data;

use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Posts\Post;
use WP_Post;

class PostDataFactory extends DataFactory
{
    public function __construct(
        protected PostDataType $postDataType
    ) {}

    public function withId(mixed $id): PostData
    {
        (object) $gateway = $this->postDataType->gateway();

        (object) $post = $gateway->withId($id);

        return new PostData(id: $id, entity: $post);
    } 

    public function createNullDataObject() : PostData
    {
        return new PostData(
            id: Data::NULL_OBJECT_ID, 
            entity: new Post(new WP_Post((object) ['ID' => 0]))
        );
    }
}