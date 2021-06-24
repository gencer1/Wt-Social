<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\AccountsController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'lm'], function () {
    //Device
    Route::get('/update-device-from-logicmonitor',[DevicesController::class,'updateDeviceFromLogicMonitorById']);
});

Route::group(['prefix'=>'maas'], function () {
    //Devices
    Route::get('/get-devices-monitorid', [DevicesController::class, 'getDevicesMonitorId']);
    Route::post('/add-device-to-maas',[DevicesController::class,'addDeviceToMaas']);

    //Accounts
    Route::post('/add-account-to-mass',[AccountsController::class,'addAccountToMaas']);
});

