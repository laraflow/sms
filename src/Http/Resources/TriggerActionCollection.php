<?php

namespace Fintech\Bell\Http\Resources;

use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TriggerActionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($action) {
            return [
                'id' => $action->getKey() ?? null,
                'trigger_id' => $action->trigger_id ?? null,
                'trigger_name' => $action->trigger->name ?? null,
                'notification_template_id' => $action->notification_template_id ?? null,
                'notification_template_name' => $action->notificationTemplate->name ?? null,
                'name' => $action->name ?? null,
                'description' => $action->description ?? null,
                'extra_recipients' => $action->extra_recipients ?? null,
                'trigger_action_data' => $action->trigger_action_data ?? null,
                'enabled' => $action->enabled ?? null,
                'links' => $action->links,
                'created_at' => $action->created_at,
                'updated_at' => $action->updated_at,
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
