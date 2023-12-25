<?php

namespace Fintech\Bell\Services;


use Fintech\Bell\Interfaces\TriggerActionRepository;

/**
 * Class TriggerActionService
 * @package Fintech\Bell\Services
 *
 */
class TriggerActionService
{
    /**
     * TriggerActionService constructor.
     * @param TriggerActionRepository $triggerActionRepository
     */
    public function __construct(TriggerActionRepository $triggerActionRepository) {
        $this->triggerActionRepository = $triggerActionRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->triggerActionRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->triggerActionRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->triggerActionRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->triggerActionRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->triggerActionRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->triggerActionRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->triggerActionRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->triggerActionRepository->create($filters);
    }
}
