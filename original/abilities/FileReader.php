<?php

namespace AutomatedEmails\Original\Abilities;

interface FileReader
{
    public function read(ReadableFile $readableFile) : mixed;
}