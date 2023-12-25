<?php

namespace Fintech\Bell\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use MongoDB\Laravel\Eloquent\Model as MongodbModel;

/**
 * Interface TriggerRecipientRepository
 * @package Fintech\Bell\Interfaces
 */
interface TriggerRecipientRepository
{
    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @param array $filters
     * @return Paginator|Collection
     */
    public function list(array $filters = []);

    /**
     * Create a new entry resource
     *
     * @param array $attributes
     * @return EloquentModel|MongodbModel|null
     */
    public function create(array $attributes = []);

    /**
     * find and update a resource attributes
     *
     * @param int|string $id
     * @param array $attributes
     * @return EloquentModel|MongodbModel|null
     */
    public function update(int|string $id, array $attributes = []);

    /**
     * find and delete a entry from records
     *
     * @param int|string $id
     * @param bool $onlyTrashed
     * @return EloquentModel|MongodbModel|null
     */
    public function find(int|string $id, $onlyTrashed = false);

    /**
     * find and delete a entry from records
     * @param int|string $id
     */
    public function delete(int|string $id);

    /**
     * find and restore a entry from records
     *
     * @param int|string $id
     * @throws \InvalidArgumentException
     */
    public function restore(int|string $id);
}
