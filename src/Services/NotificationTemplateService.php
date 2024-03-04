<?php

namespace Fintech\Bell\Services;

use Fintech\Bell\Interfaces\NotificationTemplateRepository;

/**
 * Class NotificationTemplateService
 */
class NotificationTemplateService
{
    /**
     * NotificationTemplateService constructor.
     */
    public function __construct(public NotificationTemplateRepository $notificationTemplateRepository)
    {
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->notificationTemplateRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->notificationTemplateRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->notificationTemplateRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->notificationTemplateRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->notificationTemplateRepository->list($filters);
    }

    /**
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->notificationTemplateRepository->list($filters);

    }

    public function import(array $filters)
    {
        return $this->notificationTemplateRepository->create($filters);
    }

    public function create(array $inputs = [])
    {
        return $this->notificationTemplateRepository->create($inputs);
    }
}
