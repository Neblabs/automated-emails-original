<?php

namespace AutomatedEmails\Original\Events\Wordpress\Abilities;

use Throwable;

interface ExceptionHandler
{
    public function handle(Throwable $exception);
}