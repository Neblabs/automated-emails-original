<?php

namespace AutomatedEmails\Original\Utilities\Text;

use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Environment\Env;

function __(string $translatableText) : StringManager {
    return i(\__($translatableText, domain: Env::textDomain()));
}