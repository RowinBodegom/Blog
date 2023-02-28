<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User as userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends BaseController {

    public function registerPerson(Request $request){
        $checkExist = userModel::Where("email", "=", $request["email"])
                                 ->first();

        if(!$checkExist){
            $request['password'] = Hash::make($request['password']);
            userModel::create($request->all());
        }
    }
}