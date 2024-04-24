<?php

namespace AutomatedEmails\Original\Utilities\Collection {
    use AutomatedEmails\Original\Collections\Collection;
    use stdClass;

    /**
     * Used *directly* in development only!
     * This is consider protected in production!
     */
    function _(...$stringOrArray) : Collection {
        if (count($stringOrArray) === 1 && isset($stringOrArray[0]) && (is_array($stringOrArray[0]) || $stringOrArray[0] instanceof Collection)) {
            return new Collection($stringOrArray[0]);
        }
        return new Collection($stringOrArray ?? []);
    }

    function _a(array $array) : Collection {
        return new Collection($array);
    }

    function a(...$array) : array {
        return $array;
    }

    function o(...$array) : stdClass {
        return (object) a(...$array);
    }
}


namespace {

    use AutomatedEmails\Original\Collections\Collection;
    use function AutomatedEmails\Original\Utilities\Collection\_;

    /**
     * Used in production builds only!
     */
    function neblabs_collection(array $collection = []) : Collection {
        if (count($collection) === 1 && isset($collection[0]) && (is_array($collection[0]) || $collection[0] instanceof Collection)) {
            return new Collection($collection[0]);
        }
        return new Collection($collection ?? []);
    }
}