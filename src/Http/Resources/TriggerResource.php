<?php

namespace Fintech\Bell\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TriggerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
