<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\App\Domain\Conditions\Condition;
use AutomatedEmails\App\Domain\Data\Abilities\SettableData;
use AutomatedEmails\App\Domain\Data\Data;
use AutomatedEmails\App\Domain\Data\Post\PostData;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use AutomatedEmails\Original\Validation\Validators\ValidWhen;

class {$className} extends Condition implements SettableData
{
    //protected Post \$post;

    static public function id(): string
    {
        return '{$className}';
    }  

    public function __construct(
        //here the arguments needed, as regular php variables, names must match w/ option keys
    ) {}

    /** @param PostData \$data */
    public function setData(Data \$data) : void
    {
        //\$this->post = \$data->entity();
    }

    public function canExecute() : Validator
    {
        return new Validators([]);
    }

    protected function execute(): Validator
    {
        return new ValidWhen(
            true
        );
    } 
}

TEMPLATE;
