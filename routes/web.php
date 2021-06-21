<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevicesController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'maas'], function () {
    Route::get('/get-devices-monitorid', [DevicesController::class, 'getDevicesMonitorId']);
});

