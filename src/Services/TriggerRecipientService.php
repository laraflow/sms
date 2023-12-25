<?php

namespace Fintech\Bell\Services;


use Fintech\Bell\Interfaces\TriggerRecipientRepository;

/**
 * Class TriggerRecipientService
 * @package Fintech\Bell\Services
 *
 */
class TriggerRecipientService
{
    /**
     * TriggerRecipientService constructor.
     * @param TriggerRecipientRepository $triggerRecipientRepository
     */
    public function __construct(TriggerRecipientRepository $triggerRecipientRepository) {
        $this->triggerRecipientRepository = $triggerRecipientRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->triggerRecipientRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->triggerRecipientRepository->create($inputs);
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

    public function import(array $filters)
    {
        return $this->triggerRecipientRepository->create($filters);
    }
}
