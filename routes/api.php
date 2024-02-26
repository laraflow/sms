<?php

use Fintech\Bell\Http\Controllers\NotificationTemplateController;
use Fintech\Bell\Http\Controllers\TriggerActionController;
use Fintech\Bell\Http\Controllers\TriggerController;
use Fintech\Bell\Http\Controllers\TriggerRecipientController;
use Fintech\Bell\Http\Controllers\TriggerVariableController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/
if (Config::get('fintech.bell.enabled')) {
    Route::prefix('bell')->name('bell.')
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {

            Route::get('triggers/sync',
                [TriggerController::class, 'sync'])
                ->name('triggers.sync');
            Route::apiResource('triggers', TriggerController::class);
            Route::post('triggers/{trigger}/restore',
                [TriggerController::class, 'restore'])
                ->name('triggers.restore');

            Route::apiResource('triggers', TriggerController::class);
            Route::post('triggers/{trigger}/restore',
                [TriggerController::class, 'restore'])
                ->name('triggers.restore');

            Route::apiResource('trigger-recipients', TriggerRecipientController::class);
            Route::post('trigger-recipients/{trigger_recipient}/restore',
                [TriggerRecipientController::class, 'restore'])
                ->name('trigger-recipients.restore');

            Route::apiResource('trigger-variables', TriggerVariableController::class);
            Route::post('trigger-variables/{trigger_variable}/restore',
                [TriggerVariableController::class, 'restore'])
                ->name('trigger-variables.restore');

            Route::apiResource('notification-templates', NotificationTemplateController::class);
            Route::post('notification-templates/{notification_template}/restore',
                [NotificationTemplateController::class, 'restore'])
                ->name('notification-templates.restore');

            Route::apiResource('trigger-actions', TriggerActionController::class);
            Route::post('trigger-actions/{trigger_action}/restore',
                [TriggerActionController::class, 'restore'])
                ->name('trigger-actions.restore');

            //DO NOT REMOVE THIS LINE//
        });
}
