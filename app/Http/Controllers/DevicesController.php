<?php

namespace App\Http\Controllers;

use App\Models\DevicesModel;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    public function getDevicesMonitorId(DeviceServiceInterface $deviceService){
        return $deviceService->getgetDevicesMonitorIds();
    }
}
