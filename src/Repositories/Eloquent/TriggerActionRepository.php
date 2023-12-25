<?php

namespace Fintech\Bell\Repositories\Eloquent;

use Fintech\Core\Repositories\EloquentRepository;
use Fintech\Bell\Interfaces\TriggerActionRepository as InterfacesTriggerActionRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * Class TriggerActionRepository
 * @package Fintech\Bell\Repositories\Eloquent
 */
class TriggerActionRepository extends EloquentRepository implements InterfacesTriggerActionRepository
{
    public function __construct()
    {
       $model = app(config('fintech.bell.trigger_action_model', \Fintech\Bell\Models\TriggerAction::class));

       if (!$model instanceof Model) {
           throw new InvalidArgumentException("Eloquent repository require model class to be `Illuminate\Database\Eloquent\Model` instance.");
       }

       $this->model = $model;
    }

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = [])
    {
        $query = $this->model->newQuery();

        //Searching
        if (! empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
                $query->orWhere('trigger_action_data', 'like', "%{$filters['search']}%");
            }
        }

        //Display Trashed
        if (isset($filters['trashed']) && $filters['trashed'] === true) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}
