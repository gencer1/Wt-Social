<?php

namespace App\Http\Controllers;

use App\Models\DevicesModel;
use App\Services\Device\DeviceService;
use Illuminate\Http\Request;

class DevicesController extends Controller
{

    private $deviceService;

    public function __construct()
    {
        $this->deviceService = new DeviceService();
    }

    public function getDevicesMonitorId(){
        return $this->deviceService->getDevicesMonitorIds();
    }

    public function addDeviceToMaas(Request $request){
        $data = [
            'account_id'=> '1',//Auth::user()->reseller_id;
            'refence_type'=> $request->get('refence_type'),
            'reference_id'=> $request->get('reference_id'),
            'monitoring_device_id'=> $request->get('monitoring_device_id')
        ];

        return $this->deviceService->addDeviceToMyUkFast($data);
    }

    public function updateDeviceFromLogicMonitorById(Request $request){
        $data = [
            'account_id'=> '1',//Auth::user()->reseller_id;
            'refence_type'=> $request->get('refence_type'),
            'reference_id'=> $request->get('reference_id'),
            'monitoring_device_id'=> $request->get('monitoring_device_id')
        ];

        return $this->deviceService->updateDeviceFromLogicMonitorById($data);
    }
}
