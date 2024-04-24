<?php

namespace AutomatedEmails\App\Data\Savers;

use AutomatedEmails\App\Data\Savers\Abilities\Saveable;
use AutomatedEmails\Original\Collections\Collection;

class SaverComposite implements Saveable
{
    public function __construct(
        protected Collection /*<Saveable>*/ $saveables
    ) {}
    
    public function save(mixed $data)
    {
        $this->saveables->perform(save: $data);
    } 
}