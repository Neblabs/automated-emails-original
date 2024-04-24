<?php

namespace AutomatedEmails\App\Data\Savers\Request;

use AutomatedEmails\App\Data\Savers\Abilities\RequestData;

class POSTRequestData implements RequestData
{
    public function get(string $key) : mixed
    {
        return $this->has($key)? sanitize_text_field($_POST[$key]) : null;
    }

    public function has(string $key) : bool
    {
        return isset($_POST[$key]);
    }

    public function valueIsNotNull(string $key) : bool
    {
        return $this->has($key) && sanitize_text_field($_POST[$key]) !== null;
    }
}