<?php

namespace Fintech\Bell\Services;

use Fintech\Bell\Interfaces\TriggerRepository;
use Illuminate\Support\Facades\App;

/**
 * Class TriggerService
 */
class TriggerService
{
    /**
     * TriggerService constructor.
     */
    public function __construct(public TriggerRepository $triggerRepository)
    {

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

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->triggerRepository->list($filters);

    }

    public function import(array $filters)
    {
        return $this->triggerRepository->create($filters);
    }

    public function create(array $inputs = [])
    {
        return $this->triggerRepository->create($inputs);
    }

    public function sync()
    {
        $eventDispatcher = App::make('events');

        $events = $eventDispatcher->getRawListeners();

        $onlyFintechEvents = array_filter($events, function ($event) {
            return str_starts_with($event, 'Fintech');

        }, ARRAY_FILTER_USE_KEY);

    }
}
