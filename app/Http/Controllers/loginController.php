<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class LoginController extends BaseController {

    public function checkLogin (Request $request) {
        
        if(strpos( $request , "<") !== false){
            return response()->json([
                'status' => 'failed'
            ], 400);
        }

        else {
            if($request){
                $credentials = $request->validate([
                    'name' => ['required'],
                    'password' => ['required'],
                ]);

                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    $random_token = Str::random(64);
                    User::where('id', $user->id)->update([
                        'token' => $random_token
                    ]);
                    return response()->json([
                        'token' => $random_token,
                        'userid' => $user->id,
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'failed'
                    ], 401);
                }
            }
        }
    }

    public function getUser(Request $request){
        return User::select('id', 'name', 'email', 'profile_picture','description', 'username')->where("id", $request->id)->where("token", $request->token)->first();
        
    }

    public function getUserData(Request $request){
        return User::select('name','profile_picture','profile_banner','description', 'username')->where("id", $request->id)->first();
    }

    public function test(Request $request){
        dd(session()->all());
    }

    public function logout($id){
        User::where("id", $id)->update(["token" => null]);
    }
}