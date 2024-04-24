<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Data\Finders\Automatedemails\AutomatedEmailsStructure;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\{_, a};
use function AutomatedEmails\Original\Utilities\Text\__;

Class PostTypeRegistrator implements Subscriber
{
    use DefaultPriority;

    public function __construct(
        protected AutomatedEmailsStructure $automatedEmailsStructure
    ) {}
    
    public function createEventArguments() : EventArguments
    {
        return new EventArguments(_(
            automatedEmailsId: $this->automatedEmailsStructure->fields()->id()->id()->get()
        ));
    }

    public function validator() : Validator
    {
        return new PassingValidator;
    }

    public function execute(string $automatedEmailsId) : void
    {
        register_post_type(
            post_type: $automatedEmailsId,
            args: a(
                labels: a(
                    name: __('Emails'),
                    singular_name: __('Email'),
                    menu_name: __('Automated Emails'),
                    name_admin_bar: __('Email'),
                    add_new: __('Create New'),
                    add_new_item: __('Create New Email'),
                    new_item: __('New Email'),
                    edit_item: __('Edit'),
                    //view_item: __(''),
                    all_items: __('Automated Emails'),
                    search_items: __('Search Emails'),
                    not_found: __('No Emails here, yet!'),
                    not_found_in_trash: __('No Emails here!'),
                    insert_into_item: __('Add'),
                ),
                public: false,
                publicly_queryable: false,
                show_ui: true,
                show_in_menu: true,
                query_var: false,
                has_archive: true,
                hierarchical: false,
                capability_type: 'post',
                supports: ['title', 'editor'],
            )
        );
    }
} 

