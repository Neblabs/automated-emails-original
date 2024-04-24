<?php

namespace AutomatedEmails\App\Components\Data;

use AutomatedEmails\Original\Collections\Collection;

interface DataTypeComponents
{
    public function dataTypes() : Collection; 
}