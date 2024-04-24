<?php

namespace AutomatedEmails\App\Domain\Data;

Class DataForm
{
    public const TEXT = 'text';
    public const NUMBER = 'number';

    public const URL = self::TEXT.'->'.'url';
    public const EMAIL = self::TEXT.'->'.'email';
}