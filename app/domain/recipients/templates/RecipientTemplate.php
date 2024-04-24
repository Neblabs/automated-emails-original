<?php

namespace AutomatedEmails\App\Domain\Recipients\Templates;

use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\TextTemplate;
use AutomatedEmails\App\Domain\Recipients\Recipient;
use AutomatedEmails\App\Domain\Templates\EntityTemplate;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Mapper\Types;
use AutomatedEmails\Original\Domain\Entity;
use function AutomatedEmails\Original\Utilities\Collection\_;

class RecipientTemplate extends EntityTemplate
{
    protected TextTemplate $email;

    static public function definition() : Collection
    {
        return _(
            email: Types::STRING               
        );
    }
}