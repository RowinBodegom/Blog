<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController {
    /**
     * registerPerson function
     * saves the data into the database so the user that registerd has a account to login with
     *
     * @param Request $request
     * @return void
     */
    public function registerPerson(Request $request){
        $checkExist = User::Where("email", "=", $request["email"])
                                 ->first();

        if(!$checkExist){
            $request['password'] = Hash::make($request['password']);
            User::create($request->all());
        }
    }
}