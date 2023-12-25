<?php

namespace Fintech\Bell\Services;


use Fintech\Bell\Interfaces\NotificationTemplateRepository;

/**
 * Class NotificationTemplateService
 * @package Fintech\Bell\Services
 *
 */
class NotificationTemplateService
{
    /**
     * NotificationTemplateService constructor.
     * @param NotificationTemplateRepository $notificationTemplateRepository
     */
    public function __construct(NotificationTemplateRepository $notificationTemplateRepository) {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->notificationTemplateRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->notificationTemplateRepository->create($inputs);
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

    public function import(array $filters)
    {
        return $this->notificationTemplateRepository->create($filters);
    }
}
