<?php

namespace AutomatedEmails\App\Components\Data\Builtin\Post;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\Nameable;
use AutomatedEmails\App\Components\Abilities\Provider;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostContentComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostContentRawComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostIDComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostTitleComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostTitleRawComponent;
use AutomatedEmails\App\Components\Data\Builtin\Post\Values\PostURLComponent;
use AutomatedEmails\App\Components\Data\DataTypeComponent;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\App\Domain\Data\Post\PostDataType;
use AutomatedEmails\App\Domain\Events\SupportedData\Posts;
use AutomatedEmails\App\Domain\Events\Supporteddata\GetPosts;
use AutomatedEmails\Original\Collections\Collection;
use ReflectionClass;
use Stringable;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\__;

class PostDataTypeComponent extends DataTypeComponent
{
    public function dataType() : PostDataType
    {
        return new PostDataType;
    }

    public function values(): Collection
    {
        return _(
            new PostTitleComponent,
            new PostTitleRawComponent,
            new PostContentComponent,
            new PostContentRawComponent,
            new PostIDComponent,
            new PostURLComponent
        );
    } 

    public function name()/*: \Stringable*/ 
    {
        return __('Posts');
    } 

    public function nameSingular()/*: Stringable*/
    {
        return __('Post');
    } 

    public function eventDataSetInterface() : string
    {
        return Posts::class;
    }

    public function eventDataSetTrait() : ?string
    {
        return GetPosts::class;
    }

    protected function nameSpace(): string
    {
        return __NAMESPACE__;
    } 
}
