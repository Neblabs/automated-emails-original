<?php

namespace AutomatedEmails\App\Components\Data;

use AutomatedEmails\Original\Collections\Collection;

interface DataComponents
{
    public function data() : Collection; 
}