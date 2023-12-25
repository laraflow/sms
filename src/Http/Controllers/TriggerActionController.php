<?php

namespace Fintech\Bell\Http\Controllers;
use Exception;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Http\Resources\TriggerActionResource;
use Fintech\Bell\Http\Resources\TriggerActionCollection;
use Fintech\Bell\Http\Requests\ImportTriggerActionRequest;
use Fintech\Bell\Http\Requests\StoreTriggerActionRequest;
use Fintech\Bell\Http\Requests\UpdateTriggerActionRequest;
use Fintech\Bell\Http\Requests\IndexTriggerActionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class TriggerActionController
 * @package Fintech\Bell\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to TriggerAction
 * @lrd:end
 *
 */

class TriggerActionController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *TriggerAction* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexTriggerActionRequest $request
     * @return TriggerActionCollection|JsonResponse
     */
    public function index(IndexTriggerActionRequest $request): TriggerActionCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerActionPaginate = Bell::triggerAction()->list($inputs);

            return new TriggerActionCollection($triggerActionPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *TriggerAction* resource in storage.
     * @lrd:end
     *
     * @param StoreTriggerActionRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreTriggerActionRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerAction = Bell::triggerAction()->create($inputs);

            if (!$triggerAction) {
                throw (new StoreOperationException)->setModel(config('fintech.bell.trigger_action_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Trigger Action']),
                'id' => $triggerAction->id
             ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *TriggerAction* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return TriggerActionResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): TriggerActionResource|JsonResponse
    {
        try {

            $triggerAction = Bell::triggerAction()->find($id);

            if (!$triggerAction) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            return new TriggerActionResource($triggerAction);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *TriggerAction* resource using id.
     * @lrd:end
     *
     * @param UpdateTriggerActionRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateTriggerActionRequest $request, string|int $id): JsonResponse
    {
        try {

            $triggerAction = Bell::triggerAction()->find($id);

            if (!$triggerAction) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            $inputs = $request->validated();

            if (!Bell::triggerAction()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Trigger Action']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *TriggerAction* resource using id.
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

            $triggerAction = Bell::triggerAction()->find($id);

            if (!$triggerAction) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            if (!Bell::triggerAction()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Trigger Action']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *TriggerAction* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $triggerAction = Bell::triggerAction()->find($id, true);

            if (!$triggerAction) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            if (!Bell::triggerAction()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.bell.trigger_action_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Trigger Action']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerAction* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexTriggerActionRequest $request
     * @return JsonResponse
     */
    public function export(IndexTriggerActionRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerActionPaginate = Bell::triggerAction()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Trigger Action']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerAction* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportTriggerActionRequest $request
     * @return TriggerActionCollection|JsonResponse
     */
    public function import(ImportTriggerActionRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerActionPaginate = Bell::triggerAction()->list($inputs);

            return new TriggerActionCollection($triggerActionPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}
