<?php

namespace Fintech\Bell\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;
use Fintech\Core\Abstracts\BaseModel;
use Illuminate\Support\Collection;
use InvalidArgumentException;


/**
 * Interface TriggerRepository
 */
interface TriggerRepository
{
    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = []);

    /**
     * Create a new entry resource
     *
     * @return BaseModel
     */
    public function create(array $attributes = []);

    /**
     * find and update a resource attributes
     *
     * @return BaseModel
     */
    public function update(int|string $id, array $attributes = []);

    /**
     * find and delete a entry from records
     *
     * @param  bool  $onlyTrashed
     * @return BaseModel
     */
    public function find(int|string $id, $onlyTrashed = false);

    /**
     * find and delete a entry from records
     */
    public function delete(int|string $id);

    /**
     * find and restore a entry from records
     *
     * @throws InvalidArgumentException
     */
    public function restore(int|string $id);
}
