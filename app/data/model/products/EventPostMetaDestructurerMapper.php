<?php

namespace AutomatedEmails\App\Data\Product\Mappers;

Class EventPostMetaDestructurerMapper extends DestructurerMapper
{
    public function destructure(Entity $event) : DataExport
    {
        return new DataExport([
            'meta_id' => $event->id,
            'post_id' => $event->email->id,
            'meta_key' => 'ae_event',
            'meta_value' => $event->name
        ]);
    }
}