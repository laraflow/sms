<?php

namespace Fintech\Bell\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TriggerVariableResource extends JsonResource
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
            'trigger_id' => $this->trigger_id ?? null,
            'trigger_name' => $this->trigger->name ?? null,
            'name' => $this->name ?? null,
            'value' => $this->value ?? null,
            'description' => $this->description ?? null,
            'trigger_variable_data' => $this->trigger_variable_data ?? null,
            'enabled' => $this->enabled ?? null,
            'links' => $this->links,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
