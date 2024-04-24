<?php

namespace AutomatedEmails\App\Data\Product\Mappers;

Class ConditionsPostMetaDestructurerMapper extends EntitiesDestructurerMapper
{
    protected $conditionsDesrtucturer;

    public function __construct(ConditionsPostMetaDestructurerMapper $conditionsDesrtucturer)
    {
        $this->conditionsDesrtucturer = $conditionsDesrtucturer;
    }
    
    public function destructure(Entity $conditions) : DataExport
    {
        return new DataExport([
                'meta_id' => $conditions->id,
                'post_id' => $conditions->post->id,
                'meta_key' => $conditions::KEY,
                'meta_value' => $this->getConditionsAsJson($conditions)
            ]);
    }

    protected function getConditionsAsJson(Entities $conditions) : string
    {
        return (new Collection($conditions->asArray()))->map([$this->conditiondestructurer, 'destructure'])
                                                       ->map(['$self', 'asArray'])
                                                       ->asJson();
    }
    
}