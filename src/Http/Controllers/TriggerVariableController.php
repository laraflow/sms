<?php

namespace Fintech\Bell\Http\Controllers;
use Exception;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Http\Resources\TriggerVariableResource;
use Fintech\Bell\Http\Resources\TriggerVariableCollection;
use Fintech\Bell\Http\Requests\ImportTriggerVariableRequest;
use Fintech\Bell\Http\Requests\StoreTriggerVariableRequest;
use Fintech\Bell\Http\Requests\UpdateTriggerVariableRequest;
use Fintech\Bell\Http\Requests\IndexTriggerVariableRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class TriggerVariableController
 * @package Fintech\Bell\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to TriggerVariable
 * @lrd:end
 *
 */

class TriggerVariableController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *TriggerVariable* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexTriggerVariableRequest $request
     * @return TriggerVariableCollection|JsonResponse
     */
    public function index(IndexTriggerVariableRequest $request): TriggerVariableCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerVariablePaginate = Bell::triggerVariable()->list($inputs);

            return new TriggerVariableCollection($triggerVariablePaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *TriggerVariable* resource in storage.
     * @lrd:end
     *
     * @param StoreTriggerVariableRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreTriggerVariableRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerVariable = Bell::triggerVariable()->create($inputs);

            if (!$triggerVariable) {
                throw (new StoreOperationException)->setModel(config('fintech.bell.trigger_variable_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Trigger Variable']),
                'id' => $triggerVariable->id
             ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *TriggerVariable* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return TriggerVariableResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): TriggerVariableResource|JsonResponse
    {
        try {

            $triggerVariable = Bell::triggerVariable()->find($id);

            if (!$triggerVariable) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            return new TriggerVariableResource($triggerVariable);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *TriggerVariable* resource using id.
     * @lrd:end
     *
     * @param UpdateTriggerVariableRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateTriggerVariableRequest $request, string|int $id): JsonResponse
    {
        try {

            $triggerVariable = Bell::triggerVariable()->find($id);

            if (!$triggerVariable) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            $inputs = $request->validated();

            if (!Bell::triggerVariable()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Trigger Variable']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *TriggerVariable* resource using id.
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

            $triggerVariable = Bell::triggerVariable()->find($id);

            if (!$triggerVariable) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            if (!Bell::triggerVariable()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Trigger Variable']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *TriggerVariable* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $triggerVariable = Bell::triggerVariable()->find($id, true);

            if (!$triggerVariable) {
                throw (new ModelNotFoundException)->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            if (!Bell::triggerVariable()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.bell.trigger_variable_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Trigger Variable']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerVariable* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexTriggerVariableRequest $request
     * @return JsonResponse
     */
    public function export(IndexTriggerVariableRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerVariablePaginate = Bell::triggerVariable()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Trigger Variable']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *TriggerVariable* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportTriggerVariableRequest $request
     * @return TriggerVariableCollection|JsonResponse
     */
    public function import(ImportTriggerVariableRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $triggerVariablePaginate = Bell::triggerVariable()->list($inputs);

            return new TriggerVariableCollection($triggerVariablePaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}
