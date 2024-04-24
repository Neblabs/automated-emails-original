<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\ComponentsRegistrator;
use AutomatedEmails\App\Components\Abilities\MultipleComponentsProvider;
use AutomatedEmails\App\Components\BaseComponentsRegistrator;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Collections\Validators\ItemsAreOnlyInstancesOf;
use AutomatedEmails\Original\Collections\Validators\ItemsHaveObjectTypeOf;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators;
use {$namespace}\\{$customComponentsProviderInterface->withSuffix()};

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;

class {$className} extends BaseComponentsRegistrator implements ComponentsRegistrator
{
    public function id() : StringManager
    {
        return i('');
    }

    public function canRegisterUsing(MultipleComponentsProvider \$multipleComponentsProvider) : bool
    {
        return \$multipleComponentsProvider instanceof {$customComponentsProviderInterface->withsuffix()};
    } 

    /** @param {$customComponentsProviderInterface->withsuffix()} \$multipleComponentsProvider */
    protected function componentsToRegister(MultipleComponentsProvider \$multipleComponentsProvider) : Collection
    {
        return \$multipleComponentsProvider;
    }

    protected function rulesOf(Collection \$componentsToRegister) : Validator
    {
        return new Validators([
            new ItemsAreOnlyInstancesOf(
                items: \$componentsToRegister,
                allowedTypes: _([Identifiable::class])
            ),
            new ItemsHaveObjectTypeOf(
                items: \$componentsToRegister->mapUsing(type: null),
                allowedTypes: _([Event::class])
            )
        ]);
    }
}

TEMPLATE;
