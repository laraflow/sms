<?php

namespace Fintech\Bell\Http\Controllers;

use Exception;
use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Http\Requests\ImportNotificationTemplateRequest;
use Fintech\Bell\Http\Requests\IndexNotificationTemplateRequest;
use Fintech\Bell\Http\Requests\StoreNotificationTemplateRequest;
use Fintech\Bell\Http\Requests\UpdateNotificationTemplateRequest;
use Fintech\Bell\Http\Resources\NotificationTemplateCollection;
use Fintech\Bell\Http\Resources\NotificationTemplateResource;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class NotificationTemplateController
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to NotificationTemplate
 *
 * @lrd:end
 */
class NotificationTemplateController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *NotificationTemplate* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     *
     * @lrd:end
     */
    public function index(IndexNotificationTemplateRequest $request): NotificationTemplateCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $notificationTemplatePaginate = Bell::notificationTemplate()->list($inputs);

            return new NotificationTemplateCollection($notificationTemplatePaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *NotificationTemplate* resource in storage.
     *
     * @lrd:end
     *
     * @throws StoreOperationException
     */
    public function store(StoreNotificationTemplateRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $notificationTemplate = Bell::notificationTemplate()->create($inputs);

            if (!$notificationTemplate) {
                throw (new StoreOperationException)->setModel(config('fintech.bell.notification_template_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Notification Template']),
                'id' => $notificationTemplate->id,
            ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *NotificationTemplate* resource found by id.
     *
     * @lrd:end
     *
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): NotificationTemplateResource|JsonResponse
    {
        try {

            $notificationTemplate = Bell::notificationTemplate()->find($id);

            if (!$notificationTemplate) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            return new NotificationTemplateResource($notificationTemplate);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *NotificationTemplate* resource using id.
     *
     * @lrd:end
     *
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateNotificationTemplateRequest $request, string|int $id): JsonResponse
    {
        try {

            $notificationTemplate = Bell::notificationTemplate()->find($id);

            if (!$notificationTemplate) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            $inputs = $request->validated();

            if (!Bell::notificationTemplate()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Notification Template']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *NotificationTemplate* resource using id.
     *
     * @lrd:end
     *
     * @return JsonResponse
     *
     * @throws ModelNotFoundException
     * @throws DeleteOperationException
     */
    public function destroy(string|int $id)
    {
        try {

            $notificationTemplate = Bell::notificationTemplate()->find($id);

            if (!$notificationTemplate) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            if (!Bell::notificationTemplate()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Notification Template']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *NotificationTemplate* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     *
     * @lrd:end
     *
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $notificationTemplate = Bell::notificationTemplate()->find($id, true);

            if (!$notificationTemplate) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            if (!Bell::notificationTemplate()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.bell.notification_template_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Notification Template']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *NotificationTemplate* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     */
    public function export(IndexNotificationTemplateRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $notificationTemplatePaginate = Bell::notificationTemplate()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Notification Template']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *NotificationTemplate* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @return NotificationTemplateCollection|JsonResponse
     */
    public function import(ImportNotificationTemplateRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $notificationTemplatePaginate = Bell::notificationTemplate()->list($inputs);

            return new NotificationTemplateCollection($notificationTemplatePaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}
