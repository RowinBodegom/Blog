<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController {

    public function registerPerson(Request $request){
        $checkExist = User::Where("email", "=", $request["email"])
                                 ->first();

        if(!$checkExist){
            $request['password'] = Hash::make($request['password']);
            User::create($request->all());
        }
    }
}