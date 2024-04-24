<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn\PostCategories;

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\CollectionHasItems;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class PostCategories extends Condition implements SettableData
{
    protected Post $post;

    static public function id(): string
    {
        return 'PostCategories';
    }  

    public function __construct(
        protected StringManager $permission,
        protected StringManager $quantifier,
        protected Collection $ids
    ) {}

    /** @param PostData $data */
    public function setData(Data $data) : void
    {
        $this->post = $data->entity();
    }

    public function canExecute() : Validator
    {
        return new Validators([
            new ValidWhen($this->ids->haveAny())
        ]);
    }

    protected function execute(): Validator
    {
        return new CollectionHasItems(
            collection: $this->post->categoryIds(),
            itemsToCheck: $this->ids,
            permission: $this->permission,
            quantifier: $this->quantifier
        );
    } 
}
