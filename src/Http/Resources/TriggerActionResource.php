<?php

namespace Fintech\Bell\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TriggerActionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey() ?? null,
            'trigger_id' => $this->trigger_id ?? null,
            'trigger_name' => $this->trigger->name ?? null,
            'notification_template_id' => $this->notification_template_id ?? null,
            'notification_template_name' => $this->notificationTemplate->name ?? null,
            'name' => $this->name ?? null,
            'description' => $this->description ?? null,
            'extra_recipients' => $this->extra_recipients ?? null,
            'trigger_action_data' => $this->trigger_action_data ?? null,
            'enabled' => $this->enabled ?? null,
            'links' => $this->links,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
