<?php

namespace App\Services\Account;

use App\Helpers\RequestHelper;
use App\Models\Accounts;

class AccountService{
    private $request;

    public function __construct()
    {
        $this->request = new RequestHelper();
    }

    public function addAccountToMaas($data):bool{
        try {
            Accounts::created($data);

            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}
