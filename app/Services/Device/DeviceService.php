<?php

namespace App\Services\Device;

use App\Helpers\RequestHelper;
use App\Models\Devices;

class DeviceService
{
    private $request;

    public function __construct()
    {
        $this->request = new RequestHelper();
    }

    public function addDeviceToMaas($data):bool{
        try {
            Devices::created($data);
            $this->request->postToStore('storeTestUrl',$data);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public function getDevicesMonitorIds():array{
        $reference_id = '1';//Auth::user()->reseller_id;
        $devices = json_decode(Devices::select('monitoring_device_id')->where('account_id', $reference_id)->get());

        return $devices;
    }

    public function updateDeviceFromLogicMonitorById($data):array{
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

        dd($this->request->put('/device/devices/1008',$data));//$request->get('device_id'));
    }
}
