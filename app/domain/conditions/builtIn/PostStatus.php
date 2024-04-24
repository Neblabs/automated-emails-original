<?php

namespace AutomatedEmails\App\Domain\Conditions\BuiltIn;

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Domain\Posts\Validators\IsValidPost;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class PostStatus extends Condition implements SettableData
{
    protected Post $post;

    static public function id(): string
    {
        return 'PostStatus';
    }  

    public function __construct(
        protected Collection $statuses,
        protected bool $isAllowed
    ) {}

    /** @param PostData $data */
    public function setData(Data $data) : void
    {
        $this->post = $data->post();
    }

    public function canExecute() : Validator
    {
        return new Validators([
            new IsValidPost($this->post),
            new ValidWhen($this->statuses->haveAny())
        ]);
    }

    protected function execute(): Validator
    {
        (string) $haveOrDontHave = $this->isAllowed? 'have' : 'doesNotHave';

        return new ValidWhen(
            $this->statuses->{$haveOrDontHave}($this->post->status())
        );
    } 
}