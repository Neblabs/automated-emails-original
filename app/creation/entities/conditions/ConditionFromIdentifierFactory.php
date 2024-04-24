<?php

namespace AutomatedEmails\App\Creation\Entities\Conditions;

use AutomatedEmails\App\Components\Components;
use AutomatedEmails\App\Domain\Conditions\Condition;
use ReflectionClass;
use function AutomatedEmails\Original\Utilities\Collection\_;

class ConditionFromIdentifierFactory
{
    public function __construct(
        protected Components $conditionComponents
    ) {}
    
    public function create(string $identifier, array $options) : Condition
    {
        (object) $conditionComponent = $this->conditionComponents->withId($identifier);
        (string) $condition = $conditionComponent->type(); 
        #Please note that unpacking the arguments like this will make them match the names of each 
        #option key as the argument variable name. So the option name must match the variable name
        #in php 8+. The names of your options MUST always match BOTH the order and there name. 

        return new $condition(
            ...$this->mapOptionsToConstructorArgumens($options, $condition)
        );
    }

    protected function mapOptionsToConstructorArgumens(array $options, string $Condition) : array
    {
        $reflectionClass = new ReflectionClass($Condition);
        $constructor = $reflectionClass->getConstructor();
        $sortedData = array();

        if ($constructor) {
            $params = $constructor->getParameters();
            foreach ($params as $param) {
                $name = $param->getName();
                if (isset($options[$name])) {
                    $sortedData[] = $options[$name];
                } else if ($param->isDefaultValueAvailable()) {
                    $sortedData[] = $param->getDefaultValue();
                } else {
                    throw new \Exception("Missing parameter '$name'");
                }
            }
        }

        return $sortedData;
    }
    
}