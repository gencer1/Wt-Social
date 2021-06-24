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

    public function updateDeviceFromLogicMonitorById($data,$deviceId):array{
        dd($this->request->put('/device/devices/'.$deviceId,$data));//$request->get('device_id'));
    }
}
