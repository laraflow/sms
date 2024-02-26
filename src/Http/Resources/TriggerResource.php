<?php

namespace Fintech\Bell\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TriggerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getKey() ?? null,
            'name' => $this->name ?? null,
            'code' => $this->code ?? null,
            'description' => $this->description ?? null,
            'trigger_data' => $this->trigger_data ?? null,
            'enabled' => $this->enabled ?? null,
            'triggerVariables' => $this->triggerVariables ?? null,
            'triggerRecipients' => $this->triggerRecipients ?? null,
            'links' => $this->links,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
