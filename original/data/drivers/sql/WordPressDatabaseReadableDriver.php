<?php

namespace AutomatedEmails\Original\Data\Drivers\SQL;

use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Data\Drivers\Abilities\SQLReadableDriver;
use AutomatedEmails\Original\Data\Query\Parameters;
use AutomatedEmails\Original\Data\Query\SQLParameters;
use AutomatedEmails\Original\System\ObjectWrapper;

use function AutomatedEmails\Original\Utilities\Collection\{a, _};
use wpdb;

class WordPressDatabaseReadableDriver implements SQLReadableDriver
{
    public function __construct(
        /**
         * This one is a wrapper for unit testing (mocking)
         */
        protected ObjectWrapper $wordpressDatabaseWrapper
    ) {}

    /** @param SQLParameters $parameters */
    public function findMany(Parameters $parameters): Collection
    {
        return _($this->wordpressDatabaseWrapper->call(
            method: 'get_results', 
            query: $this->wordpressDatabaseWrapper->call(
                'prepare', 
                $this->getQueryStringReplacedWithPrintfPlaceholders($parameters),
                $parameters->queryValues()->asArray()
            ),
            output: ARRAY_A
        ));            
    } 

    /** @param SQLParameters $parameters */
    public function findOne(Parameters $parameters): array|null
    {
        return $this->wordpressDatabaseWrapper->call(
            method: 'get_row', 
            query: $this->wordpressDatabaseWrapper->call(
                'prepare', 
                $this->getQueryStringReplacedWithPrintfPlaceholders($parameters),
                $parameters->queryValues()->asArray()
            ), 
            output: ARRAY_A
        );  
    } 

    // we'll optimize this in the future, for now it should work just fine...
    public function has(Parameters $parameters): bool
    {
        return (boolean) $this->findOne($parameters);
    } 

    // we'll optimize this in the future, for now it should work just fine...
    public function count(Parameters $parameters): int
    {
        return $this->findMany($parameters)->count();
    } 

    /** @param SQLParameters $parameters */
    protected function getQueryStringReplacedWithPrintfPlaceholders(Parameters $parameters) : string
    {
        (object) $query = $parameters->queryString();

        (string) $float = '%f';
        (string) $integer = '%d';
        (string) $string = '%s';

        foreach($parameters->queryValues() as $key => $value) {
            /*mixed*/ $replacement = match(is_numeric($value)) {
                true => str_contains($value, needle: '.')? $float : $integer,
                false => $string
            };

            $query = $query->replace(
                $key, 
                $replacement
            );
        }

        return $query->get();
    }
}