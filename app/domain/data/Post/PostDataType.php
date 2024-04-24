<?php

namespace AutomatedEmails\App\Domain\Data\Post;

use AutomatedEmails\App\Components\Abilities\Typeable;
use AutomatedEmails\App\Components\Data\Builtin\Post\PostDataTypeComponent;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\Original\Collections\Collection;

class PostDataType extends DataType
{
    public const ID = 'post';
    
    public function id() : string
    {
        return static::ID;
    }

    public function supportedValues() : Collection
    {
        return (new PostDataTypeComponent)->values()->map(
            fn(Typeable $valueComponent) => $valueComponent->type()
        );
    }
}