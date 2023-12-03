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
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {

            Route::apiResource('triggers', \Fintech\Bell\Http\Controllers\TriggerController::class);
            Route::post('triggers/{trigger}/restore', [\Fintech\Bell\Http\Controllers\TriggerController::class, 'restore'])->name('triggers.restore');

            //DO NOT REMOVE THIS LINE//
        });
}
