<?php

namespace Fintech\Bell\Services;

use Fintech\Bell\Interfaces\TriggerRepository;

/**
 * Class TriggerService
 */
class TriggerService
{
    /**
     * TriggerService constructor.
     */
    public function __construct(TriggerRepository $triggerRepository)
    {
        $this->triggerRepository = $triggerRepository;
    }

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->triggerRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->triggerRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->triggerRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->triggerRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->triggerRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->triggerRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->triggerRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->triggerRepository->create($filters);
    }

    public function sync()
    {
        $events = \Illuminate\Support\Facades\App::make('events');

        dd($events->getRawListeners());
    }
}
