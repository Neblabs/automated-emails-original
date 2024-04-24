<?php

return <<<TEMPLATE
<?php

namespace {$namespace};

{$implementsImports->implode("\n")}
use AutomatedEmails\App\Domain\Templates\Abilities\TemplateDefinition;
use AutomatedEmails\Original\Collections\Collection;
use {$conditionClass->fullyQualifiedClassName};
use {$conditionClass->fullyQualifiedClassName}Options;
use function AutomatedEmails\Original\Utilities\Text\__;
use function AutomatedEmails\Original\Utilities\Collection\_;

class {$componentNameWithSuffix} implements 
    {$features->implode(",\n\t")}
{
    public function identifier(): string
    {
        return '{$componentNameWithoutSuffix}';
    } 

    public function type(): string
    {
        return {$conditionClass->className}::class;
    } 

    public function options(): TemplateDefinition
    {
        return new {$conditionClass->className}Options;
    } 

    public function name(): \Stringable 
    {
        return __('');
    } 

    public function description(): \Stringable 
    {
        return __('');
    } 
}

TEMPLATE;
