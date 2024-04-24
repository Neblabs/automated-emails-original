<?php

namespace AutomatedEmails\Original\Creators\CreatorCreators\TemplateProjectFileCreator;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\CreatorCreators\TemplateProjectFileCreator\ClassFileCreatorCreator;
use AutomatedEmails\Original\Creators\Creators;
use AutomatedEmails\Original\Creators\OriginalCreators\CreatorCreators\ProjectFileCreator\ProjectFileCreatorCreator;
use AutomatedEmails\Original\Creators\Task\TaskFileCreator;

Class ClassFileCreatorCreators extends Creators
{
    public function __construct(string $creatorName, string $creatorRelativeDirectory)
    {
        $this->creatorName = $creatorName;
        $this->creatorRelativeDirectory = $creatorRelativeDirectory;
    }

    protected function getCreators() : Collection
    {
        return new Collection([
            new ClassFileCreatorCreator($this->creatorName, $this->creatorRelativeDirectory),
            new TemplateFileCreator($this->creatorName, $this->creatorRelativeDirectory),
            new TaskFileCreator($this->creatorName, $this->creatorRelativeDirectory)
        ]);
    }
}