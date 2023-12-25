<?php

namespace Fintech\Bell\Http\Resources;

use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TriggerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($trigger) use ($request){
            $data = [
                'id' => $trigger->getKey() ?? null,
                'name' => $trigger->name ?? null,
                'code' => $trigger->code ?? null,
                'description' => $trigger->description ?? null,
                'trigger_data' => $trigger->trigger_data ?? null,
                'enabled' => $trigger->enabled ?? null,
                'variables' => [],
                'recipients' => [],
                'templates' => [],
                'links' => $trigger->links,
                'created_at' => $trigger->created_at,
                'updated_at' => $trigger->updated_at,
            ];

            if ($request->has('with_detail') && $request->boolean('with_detail')) {
                $data['variables'] = $trigger->triggerVariables ?? [];
                $data['recipients'] = $trigger->triggerRecipients ?? [];
                $data['templates'] = $trigger->notificationTemplates ?? [];
            }

            return $data;

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
