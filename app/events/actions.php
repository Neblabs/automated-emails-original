<?php

use function AutomatedEmails\Original\Utilities\Collection\a;

return a(
    init: [
        'AutomatedEmails\\App\\Subscribers\\PostTypeRegistrator',
        'AutomatedEmails\\App\\Subscribers\\ComponentsRegistrator',
        'AutomatedEmails\\App\\Subscribers\\EventsRegistrator',
        'AutomatedEmails\\App\\Subscribers\\DefaultPostStatusesRegistrator',
        'AutomatedEmails\\App\\Subscribers\\DefaultUserRolesRegistrator',
        'AutomatedEmails\\App\\Subscribers\\DashboardDataIntegrationTestExposer',
    ],
    admin_enqueue_scripts: [
        'AutomatedEmails\\App\\Subscribers\\DashboardScriptsRegistrator',
    ],
    in_admin_header: [
        'AutomatedEmails\\App\\Subscribers\\DashboardBaseElementRenderer',
    ],
    save_post: [
        'AutomatedEmails\\App\\Subscribers\\AutomatedEmailsDataSaver',
    ],
);