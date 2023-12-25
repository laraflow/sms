<?php

namespace Fintech\Bell\Http\Controllers;
use Exception;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Http\Resources\TriggerRecipientResource;
use Fintech\Bell\Http\Resources\TriggerRecipientCollection;
use Fintech\Bell\Http\Requests\ImportTriggerRecipientRequest;
use Fintech\Bell\Http\Requests\StoreTriggerRecipientRequest;
use Fintech\Bell\Http\Requests\UpdateTriggerRecipientRequest;
use Fintech\Bell\Http\Requests\IndexTriggerRecipientRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class TriggerRecipientController
 * @package Fintech\Bell\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to TriggerRecipient
 * @lrd:end
 *
 */

class TriggerRecipientController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *TriggerRecipient* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexTriggerRecipientRequest $request
     * @return TriggerRecipientCollection|JsonResponse
     */
    public function index(IndexTriggerRecipientRequest $request): TriggerRecipientCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerRecipientPaginate = Bell::triggerRecipient()->list($inputs);

            return new TriggerRecipientCollection($triggerRecipientPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *TriggerRecipient* resource in storage.
     * @lrd:end
     *
     * @param StoreTriggerRecipientRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreTriggerRecipientRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerRecipient = Bell::triggerRecipient()->create($inputs);

            if (!$triggerRecipient) {
                throw (new StoreOperationException)->setModel(config('fintech.bell.trigger_recipient_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Trigger Recipient']),
                'id' => $triggerRecipient->id
             ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *TriggerRecipient* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return TriggerRecipientResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): TriggerRecipientResource|JsonResponse
    {
        try {

            $triggerRecipient = Bell::triggerRecipient()->find($id);

            if (!$triggerRecipient) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            return new TriggerRecipientResource($triggerRecipient);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *TriggerRecipient* resource using id.
     * @lrd:end
     *
     * @param UpdateTriggerRecipientRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateTriggerRecipientRequest $request, string|int $id): JsonResponse
    {
        try {

            $triggerRecipient = Bell::triggerRecipient()->find($id);

            if (!$triggerRecipient) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            $inputs = $request->validated();

            if (!Bell::triggerRecipient()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Trigger Recipient']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *TriggerRecipient* resource using id.
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws DeleteOperationException
     */
    public function destroy(string|int $id)
    {
        try {

            $triggerRecipient = Bell::triggerRecipient()->find($id);

            if (!$triggerRecipient) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            if (!Bell::triggerRecipient()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Trigger Recipient']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *TriggerRecipient* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $triggerRecipient = Bell::triggerRecipient()->find($id, true);

            if (!$triggerRecipient) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            if (!Bell::triggerRecipient()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.bell.trigger_recipient_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Trigger Recipient']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerRecipient* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexTriggerRecipientRequest $request
     * @return JsonResponse
     */
    public function export(IndexTriggerRecipientRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerRecipientPaginate = Bell::triggerRecipient()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Trigger Recipient']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerRecipient* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportTriggerRecipientRequest $request
     * @return TriggerRecipientCollection|JsonResponse
     */
    public function import(ImportTriggerRecipientRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerRecipientPaginate = Bell::triggerRecipient()->list($inputs);

            return new TriggerRecipientCollection($triggerRecipientPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}
