<?php

namespace Fintech\Bell\Services;

use Fintech\Bell\Interfaces\TriggerRecipientRepository;

/**
 * Class TriggerRecipientService
 */
class TriggerRecipientService
{
    /**
     * TriggerRecipientService constructor.
     */
    public function __construct(TriggerRecipientRepository $triggerRecipientRepository)
    {
        $this->triggerRecipientRepository = $triggerRecipientRepository;
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->triggerRecipientRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->triggerRecipientRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->triggerRecipientRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->triggerRecipientRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->triggerRecipientRepository->list($filters);
    }

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->triggerRecipientRepository->list($filters);

    }

    public function import(array $filters)
    {
        return $this->triggerRecipientRepository->create($filters);
    }

    public function create(array $inputs = [])
    {
        return $this->triggerRecipientRepository->create($inputs);
    }
}
