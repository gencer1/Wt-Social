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
            'relatedDeviceId'=> -1,
            'displayName'=> 'Cisco Router',
            'link'=> 'www.ciscorouter.com',
            'description'=> 'This is a Cisco Router',
            'disableAlerting'=> true,
            'autoBalancedCollectorGroupId'=> 0,
            'enableNetflow'=> true,
            //'hostGroupIds'=> '16,4,3',
            'deviceType'=> 0,
            'currentCollectorId'=> 1,
            'netflowCollectorId'=> 1,
            'customProperties'=> [
                [
                    'name'=> 'addr',
                    'value'=> '127.0.0.1'
                ]
            ],
            'preferredCollectorId'=> 2,
            'name'=> '192.168.1.1'
        ];


        return $this->deviceService->updateDeviceFromLogicMonitorById($data,$request->get('device_id'));
    }
}
