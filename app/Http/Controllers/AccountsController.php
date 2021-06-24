<?php

namespace App\Http\Controllers;

use App\Services\Account\AccountService;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function addAccountToMaas(Request $request){
        $data = [
            'reference_id'=> $request->get('reference_id')
        ];

        return AccountService::addAccountToMaas($data);
    }
}
