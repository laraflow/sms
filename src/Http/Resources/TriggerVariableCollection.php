<?php

namespace Fintech\Bell\Http\Resources;

use Fintech\Core\Supports\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TriggerVariableCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($variable) {
            return [
                'id' => $variable->getKey() ?? null,
                'trigger_id' => $variable->trigger_id ?? null,
                'trigger_name' => $variable->trigger->name ?? null,
                'name' => $variable->name ?? null,
                'value' => $variable->value ?? null,
                'description' => $variable->description ?? null,
                'trigger_variable_data' => $variable->trigger_variable_data ?? null,
                'enabled' => $variable->enabled ?? null,
                'links' => $variable->links,
                'created_at' => $variable->created_at,
                'updated_at' => $variable->updated_at,
            ];
        })->toArray();
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
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
