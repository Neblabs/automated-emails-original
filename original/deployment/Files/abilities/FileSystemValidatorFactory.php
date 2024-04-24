<?php

namespace AutomatedEmails\Original\Deployment\Files\Abilities;

use AutomatedEmails\Original\Validation\Validator;

interface FileSystemValidatorFactory
{
    public function copy($originFile, $targetFile) : Validator;
    public function remove($files) : Validator;
    public function rename($origin, $target, $overwrite = false) : Validator;
}