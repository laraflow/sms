<?php

use Illuminate\Support\Facades\Route;

if (config('sms.log_viewer.enabled')) {
    Route::prefix(config('sms.log_viewer.uri'))->group(function () {
        Route::get('/', [\Laraflow\Sms\Controllers\SmsLogController::class, 'index'])->name('sms-logs.index');
        Route::get('/{date}', [\Laraflow\Sms\Controllers\SmsLogController::class, 'show'])->name('sms-logs.show');
        Route::delete('/{date}', [\Laraflow\Sms\Controllers\SmsLogController::class, 'destroy'])->name('sms-logs.destroy');
    });
}
