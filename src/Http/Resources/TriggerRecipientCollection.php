<?php

namespace Fintech\Bell\Http\Resources;

use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TriggerRecipientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($recipient) {
            return [
                'id' => $recipient->getKey() ?? null,
                'trigger_id' => $recipient->trigger_id ?? null,
                'trigger_name' => $recipient->trigger->name ?? null,
                'name' => $recipient->name ?? null,
                'description' => $recipient->description ?? null,
                'trigger_recipient_data' => $recipient->trigger_recipient_data ?? null,
                'enabled' => $recipient->enabled ?? null,
                'links' => $recipient->links,
                'created_at' => $recipient->created_at,
                'updated_at' => $recipient->updated_at,
            ];
        })->toArray();
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'options' => [
                'dir' => Constant::SORT_DIRECTIONS,
                'per_page' => Constant::PAGINATE_LENGTHS,
                'sort' => ['id', 'name', 'created_at', 'updated_at'],
            ],
            'query' => $request->all(),
        ];
    }
}
