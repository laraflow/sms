<?php

namespace Fintech\Bell\Http\Resources;

use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationTemplateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($template) {
            return [
                'id' => $template->getKey() ?? null,
                'trigger_id' => $template->trigger_id ?? null,
                'trigger_name' => $template->trigger_name ?? null,
                'name' => $template->name ?? null,
                'type' => $template->type ?? null,
                'content' => $template->content ?? null,
                'notification_template_data' => $template->notification_template_data ?? null,
                'enabled' => $template->enabled ?? null,
                'links' => $template->links,
                'created_at' => $template->created_at,
                'updated_at' => $template->updated_at,
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
