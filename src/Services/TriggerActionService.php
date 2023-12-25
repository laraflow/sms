<?php

namespace Fintech\Bell\Services;

use Fintech\Bell\Interfaces\TriggerActionRepository;

/**
 * Class TriggerActionService
 */
class TriggerActionService
{
    /**
     * TriggerActionService constructor.
     */
    public function __construct(TriggerActionRepository $triggerActionRepository)
    {
        $this->triggerActionRepository = $triggerActionRepository;
    }

    /**
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
