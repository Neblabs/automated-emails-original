<?php

namespace AutomatedEmails\App\Data\Product\Mappers;

Class ProductDatabasePostTypeCreatorMapper extends CreatorMapper
{
    protected $eventsCreatorMapper;

    public function __construct(EventsCreatorMapper $eventsCreatorMapper)
    {
        $this->eventsCreatorMapper = $eventsCreatorMapper;
    }
    
    public function create(Collection $data) : Entity
    {
        (object) $email = $this->emailGateway->findwithId($postId)->first();

        $email->conditions->replaceWith($updatedConditions);

        $email->conditions->add(new Condition([
            'data' => 'whatever'
        ]));

        $this->emailGateway->update($email);

        return new AutomatedEmail([
            'id' => $data->get('id'),
            'event' => $this->eventsCreatorMapper->create([
                'id' => $data->get('event_id')
            ]),
            'conditions' => $this->conditionsCreatorMapper->create([
                'conditions' => $data->get('conditions')
            ])
        ]);
    }
}