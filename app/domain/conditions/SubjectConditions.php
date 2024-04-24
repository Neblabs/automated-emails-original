<?php

namespace AutomatedEmails\App\Domain\Conditions;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\Original\Domain\Entity;

class SubjectConditions extends Entity implements Passable
{
    public function __construct(
        public readonly Data $data,
        // the conditions wrapped in the mode: AllMustPass, OnlyOneMustPass...
        public readonly PassableComposite $passableComposite,
    ) {
        $passableComposite->items()->perform(setData: $data);
    }

    public function passes(): bool
    {
        return $this->passableComposite->passes();
    }
}
/**
new AllMustPass(_(
    new SubjectConditions(
        //data: [post | UpdatedPost]
        //conditions: new OnlyOneMustPass([
            condition1, 
            condition2, 
            ...
        ])
    )
    new SubjectConditions(_(

    ))
))

{
    type: "PassableComposite",
    id: 'AND',
    passable: [
        {
            type: "SubjectConditions",
            data: [post | UpdatedPost],
            passable: [
                {
                    type: "PostStatus",
                    options: {
                        statuses: [1, 2],
                        isAllowed: true
                    }                    
                }
            ]
        }
    ]
}

*/