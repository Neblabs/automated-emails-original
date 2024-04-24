<?php
return <<<TEMPLATE
<?php declare(strict_types=1);

use {$originalFileData->get('componentClassName')->get('fullyQualifiedClassName')};
use AutomatedEmails\App\Tests\Events\WordPressUpdatePostRunner;

use function AutomatedEmails\Original\Utilities\Collection\{a, _, o};

(array) \$defaultEntities = [
    o(
        type: 'user',
        typeId: 'the_user_author_of_the_post_that_we_will_update',
        dependsOn: [],
        data: o(
            role: 'editor',
            user_email: 'rafa@mail.com'
        )
    ),

];

itMaySendEmails('does not send them (no custom conditions)')->with(a(
    newStatusIsDraft: fn() => a(
        eventRunners: [new WordPressUpdatePostRunner],
        data: a(
            entities: [
                ...\$defaultEntities,
                o(
                    type: 'post',
                    typeId: 'the_post_that_we_will_update',
                    dependsOn: ['the_user_author_of_the_post_that_we_will_update'],
                    data: o(
                        post_status: 'publish',
                        post_author: '((the_user_author_of_the_post_that_we_will_update.ID))',
                        post_title: 'My first post!'
                    )
                ),
                //automated emails
                o(
                    type: 'automatedemail',
                    typeId: 'i cant think of one rn',
                    dependsOn: [],
                    eventComponentClass: {$originalFileData->get('componentClassName')->get('className')}::class,
                    data: o(
                        conditions: _(
                            type: 'all',
                            subjectConditions: [
                                _(
                                    data: '[post | UpdatedPost]',
                                    passableCompositeConditions: a(
                                        type: 'all',
                                        conditions: [
                                            _(
                                                type: 'PostStatus',
                                                options: a(
                                                    statuses: ['publish'],
                                                    isAllowed: true
                                                )
                                            )->asArray()
                                        ]
                                    )
                                )
                            ]
                        )->asJson(),
                        recipients: _(
                            _(email: '((user.email | PostAuthor))')->asJson()
                        ),
                        subject: 'Sending to: ((user.email | PostAuthor))',
                        body: 'This is the title: ((post.title | UpdatedPost))',
                    )
                )
            ],
            assert: o(
                emailHasBeenSent: false,
                expectedEmailData: a(
                    to: ['rafa@mail.com'],
                    subject: 'Sending to: rafa@mail.com',
                    message: 'This is the title: My first post!',
                    headers: [],
                    attachments: []
                )
            ),
            test: o(
                post: o(
                    typeIdOfThePostToUpdate: 'the_post_that_we_will_update',
                    data: a(
                        post_status: 'draft'
                    )
                )
            )
        )
    ),
))->todo();
/*
itMaySendEmails('sends them')->with(a(
    whenPostStatusIsUpdatedToPublish: fn() => a(
        eventRunners: [new WordPressUpdatePostRunner],
        data: a(
            entities: [
                ...\$defaultEntities,
                o(
                    type: 'post',
                    typeId: 'the_post_that_we_will_update',
                    dependsOn: ['the_user_author_of_the_post_that_we_will_update'],
                    data: o(
                        post_status: 'draft',
                        post_author: '((the_user_author_of_the_post_that_we_will_update.ID))',
                        post_title: 'My first post!'
                    )
                ),
                //automated emails
                o(
                    type: 'automatedemail',
                    typeId: 'i cant think of one rn',
                    dependsOn: [],
                    eventComponentClass: {$originalFileData->get('componentClassName')->get('className')}::class,
                    data: o(
                        conditions: _(
                            type: 'all',
                            subjectConditions: [
                                _(
                                    data: '[post | UpdatedPost]',
                                    passableCompositeConditions: a(
                                        type: 'all',
                                        conditions: [
                                            _(
                                                type: 'PostStatus',
                                                options: a(
                                                    statuses: ['publish'],
                                                    isAllowed: true
                                                )
                                            )->asArray()
                                        ]
                                    )
                                )
                            ]
                        )->asJson(),
                        recipients: _(
                            _(email: '((user.email | PostAuthor))')->asJson()
                        ),
                        subject: 'Sending to: ((user.email | PostAuthor))',
                        body: 'This is the title: ((post.title | UpdatedPost))',
                    )
                )
            ],
            assert: o(
                emailHasBeenSent: true,
                expectedEmailData: a(
                    to: ['rafa@mail.com'],
                    subject: 'Sending to: rafa@mail.com',
                    message: 'This is the title: My first post!',
                    headers: [],
                    attachments: []
                )
            ),
            test: o(
                post: o(
                    typeIdOfThePostToUpdate: 'the_post_that_we_will_update',
                    data: a(
                        post_status: 'publish'
                    )
                )
            )
        )
    )
));*/
TEMPLATE;