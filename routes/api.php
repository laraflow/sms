<?php

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
//        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {

            Route::apiResource('triggers', \Fintech\Bell\Http\Controllers\TriggerController::class);
            Route::post('triggers/{trigger}/restore', [\Fintech\Bell\Http\Controllers\TriggerController::class, 'restore'])->name('triggers.restore');

            Route::apiResource('triggers', \Fintech\Bell\Http\Controllers\TriggerController::class);
            Route::post('triggers/{trigger}/restore', [\Fintech\Bell\Http\Controllers\TriggerController::class, 'restore'])->name('triggers.restore');

            Route::apiResource('trigger-recipients', \Fintech\Bell\Http\Controllers\TriggerRecipientController::class);
            Route::post('trigger-recipients/{trigger_recipient}/restore', [\Fintech\Bell\Http\Controllers\TriggerRecipientController::class, 'restore'])->name('trigger-recipients.restore');

            Route::apiResource('trigger-variables', \Fintech\Bell\Http\Controllers\TriggerVariableController::class);
            Route::post('trigger-variables/{trigger_variable}/restore', [\Fintech\Bell\Http\Controllers\TriggerVariableController::class, 'restore'])->name('trigger-variables.restore');

            Route::apiResource('notification-templates', \Fintech\Bell\Http\Controllers\NotificationTemplateController::class);
            Route::post('notification-templates/{notification_template}/restore', [\Fintech\Bell\Http\Controllers\NotificationTemplateController::class, 'restore'])->name('notification-templates.restore');

            Route::apiResource('trigger-actions', \Fintech\Bell\Http\Controllers\TriggerActionController::class);
            Route::post('trigger-actions/{trigger_action}/restore', [\Fintech\Bell\Http\Controllers\TriggerActionController::class, 'restore'])->name('trigger-actions.restore');

            //DO NOT REMOVE THIS LINE//
        });
}
