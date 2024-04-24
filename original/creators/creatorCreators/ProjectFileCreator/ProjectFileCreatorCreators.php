<?php

namespace AutomatedEmails\Original\Creators\CreatorCreators\ProjectFileCreator;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Creators\Creators;

Class ProjectFileCreatorCreators extends Creators
{
    public function __construct(string $creatorName, string $creatorRelativeDirectory)
    {
        $this->creatorName = $creatorName;
        $this->creatorRelativeDirectory = $creatorRelativeDirectory;
    }

    protected function getCreators() : Collection
    {
        return new Collection([
            new ProjectFileCreatorCreator($this->creatorName, $this->creatorDirectory)
        ]);
    }
}