<?php

namespace AutomatedEmails\App\Components\Conditions\Builtin\Options;

use AutomatedEmails\App\Components\Abilities\HasLabels;
use AutomatedEmails\App\Components\Abilities\HasTemplateOptions;
use AutomatedEmails\App\Components\Abilities\RenderableOptions;
use AutomatedEmails\App\Domain\Conditions\Builtin\PostStatusOptions;
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;

use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Collection\a;
use function AutomatedEmails\Original\Utilities\Collection\_a;

class PostStatusOptionsComponent implements HasTemplateOptions, RenderableOptions, HasLabels
{
    public function __construct(
        protected Collection $postStatuses
    ) {}
    
    public function options(): TemplateDefinition
    {
        return new PostStatusOptions($this->postStatuses);
    }

    public function render() : Collection
    {
        return  _a([
            //each array item is a line
            ['isAllowed', 'statuses'],
            //['excludeThese']
            //['excludeThese']
        ]);
    } 

    public function labels() : Collection 
    {
        return _(
            statuses: a(
                labels: a(
                    //maybe: a(right: 'all of this must pass', top: 'read this',  etc)
                ),
                values: fn(Collection $allowedValues) => $allowedValues->map(fn(string $postStatus) => match($postStatus) {
                    'publish' => a(
                        type: 'publish',
                        name: __('Publish'),
                        description: __('Viewable by everyone. (publish)')
                    ),
                    'future' => a(
                        type: 'future',
                        name: __('Future'),
                        description: __('Scheduled to be published in a future date. (future)')
                    ),
                    'draft' => a(
                        type: 'draft',
                        name: __('Draft'),
                        description: __('Incomplete post viewable by anyone with proper user role. (draft)')
                    ),
                    'pending' => a(
                        type: 'pending',
                        name: __('Pending'),
                        description: __('Submitted for review. Awaiting a user with the publish_posts capability (typically a user assigned the Editor role) to publish. (pending)')
                    ),
                    'private' => a(
                        type: 'private',
                        name: __('Private'),
                        description: __('Viewable only to WordPress users at Administrator level. (private)')
                    ),
                    'trash' => a(
                        type: 'trash',
                        name: __('Trash'),
                        description: __('Posts in the Trash are assigned the trash status. (trash)')
                    ),
                    default => a(
                        type: $postStatus,
                        name: $postStatus,
                        description: ('')
                    )
                })->getValues()
            ),
            isAllowed: a(
                labels: a(),
                values: fn() => [
                    a(
                        type: true,
                        name: __('Is'),
                        description: __('Only the selected items are allowed')
                    ),
                    a(
                        type: false,
                        name: __('Is Not'),
                        description: __('All items are allowed except the selected items')
                    )
                ]
            )
        );
    } 
}