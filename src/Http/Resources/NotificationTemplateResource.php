<?php

namespace Fintech\Bell\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationTemplateResource extends JsonResource
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
            'trigger_name' => $this->trigger_name ?? null,
            'name' => $this->name ?? null,
            'type' => $this->type ?? null,
            'content' => $this->content ?? null,
            'notification_template_data' => $this->notification_template_data ?? null,
            'enabled' => $this->enabled ?? null,
            'links' => $this->links,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
