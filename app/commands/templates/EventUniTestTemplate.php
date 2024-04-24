<?php
return <<<TEMPLATE
<?php declare(strict_types=1);

use {$originalFileData->get('namespace')}\\{$originalFileData->get('className')};
use AutomatedEmails\App\Tests\MockEventTestHelper;
use AutomatedEmails\Original\Construction\Events\HookFactory;
use AutomatedEmails\Original\Events\Wordpress\EventHandler;
use AutomatedEmails\Original\Events\Wordpress\SubscribersNotifier;
use AutomatedEmails\Original\Validation\Validator;

it('methods get passed the correct argument data', function() {
    (object) \$eventTest = \$this->mockEventTestData({$originalFileData->get('className')}::class);

    (object) \$wp_post = new WP_Post((object) ['ID' => 0, 'post_title' => 'Hello World']);
    (object) \$post = new Post(\$wp_post);

    \$eventTest->setExpectedMethodArguments(method: 'validator', arguments: (object) [
        'old' => 'draft',
        'new' => 'publish'
    ]);
    \$eventTest->setExpectedMethodArguments(method: 'posts', arguments: \$post);

    \$eventTest->testWithHookArguments(
        \$new_status = 'publish', \$old_status = 'draft', \$post = \$wp_post
    );
})->todo();
/*
it('generates the expected data (posts and users)', function() {
    (object) \$wp_post = new WP_Post((object) ['ID' => 0, 'post_title' => 'Hello World']);

    (object) \$eventTest = \$this->realEventTestData({$originalFileData->get('className')}::class)
                               ->testWithHookArguments(
                                   \$new_status = 'publish', \$old_status = 'draft', \$post = \$wp_post
                               )->assertDataSet(
                                    methodName: 'postsData',
                                    isInstance: PostsData::class,
                                    equals: new PostsData([
                                        new PostData(
                                            id: 'UpdatedPost', 
                                            entity: new Post(\$wp_post)
                                        )
                                    ])
                                )->assertDataSet(
                                    methodName: 'usersData',
                                    isInstance: UsersData::class,
                                    equals: new UsersData([
                                        new UserData(id: 'LoggedInUser', entity: new User(new WP_User)),
                                        new UserData(id: 'PostAuthor', entity: new User(new WP_User))
                                    ])
                                )->assertPostHasTheSameSourceInstance(
                                    dataId: 'UpdatedPost',
                                    expects: \$wp_post
                                );
});

it('validation passes')->assertEventValidationPasses(
    Event: {$originalFileData->get('className')}::class,
    scenariosWithArgumentsPassedToTheValidator: [
        'statuses are different' => 'new Post status is "new"' => a(
            new: new Post(new WP_Post(o(ID: 23, post_status: 'new', filter: 'raw'))), 
        ),
    ]
);

it('validation fails')->assertEventValidationFails(
    Event: {$originalFileData->get('className')}::class,
    scenariosWithArgumentsPassedToTheValidator: [
        'statuses are the same' => 'new Post status is "new"' => a(
            new: new Post(new WP_Post(o(ID: 23, post_status: 'new', filter: 'raw'))), 
        ),
    ]
);*/
TEMPLATE;