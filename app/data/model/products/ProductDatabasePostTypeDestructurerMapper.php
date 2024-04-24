<?php

namespace AutomatedEmails\App\Data\Product\Mappers;

Class ProductDatabasePostTypeDestructurerMapper extends DestructurerMapper
{
    protected $eventsCreatorMapper;

    public function __construct(EventsCreatorMapper $eventsCreatorMapper)
    {
        $this->eventsCreatorMapper = $eventsCreatorMapper;
    }
    
    public function destructure(Entity $automatedEmail) : DataExport
    {
        return new DataExport(
            $self = [
                'id' => $automatedEmail->id,
            ],
            $relations = [
                PostMetaGateway::class => [
                    $automatedEmail->event,
                    $automatedEmail->conditions,
                    $automatedEmail->recepients,
                ]
            ]
        );
    }
}