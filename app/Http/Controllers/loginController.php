<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User as userModel;
use Illuminate\Http\Request;


class loginController extends BaseController {
    public $user;

    public function __construct(){
        $this->user = new userModel;
    }

    public function checkLogin (Request $request) {
        if(strpos( $request , "<") !== false){
            return response()->json([
                'status' => 'failed'
            ], 400);
        } else {
            if($request){
                $credentials = $request->validate([
                    'name' => ['required'],
                    'password' => ['required'],
                ]);
                
                if (Auth::attempt($credentials)) {
                    echo Auth::user()->email;    
                }
                else {
                    return response()->json([
                        'status' => 'failed'
                    ], 401);
                }
            }
        }
    }
}