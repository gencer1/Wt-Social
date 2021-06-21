<?php

namespace App\Services\Device;

use App\Helpers\RequestHelper;
use App\Models\Device;
use App\Models\DevicesModel;

class DeviceService implements DeviceServiceInterface
{
    private $request;

    public function __construct()
    {
        $this->request = new RequestHelper();
    }

    public function getDevicesMonitorIds():array{
        $reference_id = Auth::user()->reseller_id;
        $device = DevicesModel::select('monitoring_device_id')->where('account_id', $reference_id)->get();

        return $device;
    }
}
