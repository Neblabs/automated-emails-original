<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Creation\Validators\NonceValidatorFactory;
use AutomatedEmails\App\Data\Savers\Abilities\RequestData;
use AutomatedEmails\App\Data\Savers\Request\POSTRequestData;
use AutomatedEmails\App\Data\Savers\WordPressPostSaver;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;
use WP_Post;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class AutomatedEmailsDataSaver implements Subscriber
{
    use DefaultPriority;

    public function __construct(
        protected WordPressPostSaver $wordPressPostSaver,
        protected StringManager $automatedEmailsPostTypeId,
        protected NonceValidatorFactory $nonceValidatorFactory
    ) {}
    
    public function createEventArguments(int $postId, WP_Post $post) : EventArguments
    {
        return new EventArguments(_(
            post: new Post($post),
            requestData: new POSTRequestData
        ));
    }

    public function validator(Post $post, RequestData $requestData) : Validator
    {

        //dd($_POST, $requestData->get(Env::getWithPrefix('dashboard_nonce')));
        return new Validators([
            new ValidWhen($post->type()->is($this->automatedEmailsPostTypeId)),
            $this->wordPressPostSaver->canBeSaved($requestData),
            $this->nonceValidatorFactory->create(
                nonce: (string) $requestData->get(Env::getWithPrefix('dashboard_nonce')), 
                action: Env::getWithPrefix('dashboard_nonce')
            )
        ]);
    }

    public function execute(Post $post, RequestData $requestData) : void
    {
        $this->wordPressPostSaver->setPost($post);
        $this->wordPressPostSaver->save($requestData);
    }
} 

