<?php

namespace AutomatedEmails\App\Domain\Data\Post;

use AutomatedEmails\App\Creation\Data\PostDataFactory;
use AutomatedEmails\App\Creation\DataFactory;
use AutomatedEmails\App\Domain\Data\DataCollection;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;

Class PostsData extends DataCollection
{
    public function id(): string
    {
        return PostDataType::ID;        
    }

    protected function getDomainClass() : string
    {
        return PostData::class;
    }

    protected function dataFactory(): DataFactory
    {
        return new PostDataFactory(new PostDataType);
    }  
}