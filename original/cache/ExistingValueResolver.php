<?php

namespace AutomatedEmails\Original\Cache;

use AutomatedEmails\Original\Cache\Abilities\ValueResolver;
use Closure;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Utilities\TypeChecker;
use AutomatedEmails\Original\Characters\StringManager;

Class ExistingValueResolver implements ValueResolver
{
    use TypeChecker;

    protected $key;
    protected $data;

    public function __construct(array $keyAndData)
    {
        $this->key = new StringManager($keyAndData['key']);
        $this->data = $keyAndData['data'];
    }

    public function otherwise(callable $getter) : mixed
    {
        if ($this->data->hasKey($this->key)) {
            return $this->data->get($this->key);
        }

        $value = ($getter instanceof Closure)? $this->call($getter) : $getter;

        $this->data->add($this->key, $value);
        
        return $value;       
    }

    public function call(Callable $returnValue)
    {
        return $returnValue($this->key);
    }
    
}