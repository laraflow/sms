<?php

namespace Fintech\Bell\Repositories\Mongodb;

use Fintech\Core\Repositories\MongodbRepository;
use Fintech\Bell\Interfaces\TriggerRecipientRepository as InterfacesTriggerRecipientRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Eloquent\Model;
use InvalidArgumentException;

/**
 * Class TriggerRecipientRepository
 * @package Fintech\Bell\Repositories\Mongodb
 */
class TriggerRecipientRepository extends MongodbRepository implements InterfacesTriggerRecipientRepository
{
    public function __construct()
    {
       $model = app(config('fintech.bell.trigger_recipient_model', \Fintech\Bell\Models\TriggerRecipient::class));

       if (!$model instanceof Model) {
           throw new InvalidArgumentException("Mongodb repository require model class to be `MongoDB\Laravel\Eloquent\Model` instance.");
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
                $query->orWhere('trigger_recipient_data', 'like', "%{$filters['search']}%");
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
