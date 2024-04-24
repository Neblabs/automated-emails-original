<?php

namespace AutomatedEmails\App\Domain\ConditionRoots;

use AutomatedEmails\App\Domain\Conditions\Abilities\Passable;
use AutomatedEmails\App\Domain\Conditions\PassableComposite;
use AutomatedEmails\App\Domain\Conditions\SubjectConditions;
use AutomatedEmails\Original\Domain\Entity;

Class ConditionsRoot extends Entity implements Passable
{
    private PassableComposite $root;

    public function passes(): bool
    {
        return $this->root->passes();    
    } 

    public function setRoot(PassableComposite $root) 
    {
        $this->root = $root;
    }

    public function appendSubjectConditions(SubjectConditions $subjectConditions) : void
    {
        $this->root->append($subjectConditions);
    }

    public function prependSubjectConditions(SubjectConditions $subjectConditions) : void
    {
        $this->root->prepend($subjectConditions);
    }

}