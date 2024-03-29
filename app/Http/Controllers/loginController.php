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

    /**
     * checkLogin function
     * checks if the user is valid and sends the data back to the so it can be saved into a session
     *
     * @param Request $request
     * @return Array
     */
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
                    return response()->json([
                        "userID" => $user->id,
                        'name' => $user->name,
                        'mail' => $user->email,
                        'profile_picture' => $user->profile_picture,
                        'profile_banner' => $user->profile_banner
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
    /**
     * getUser function
     * gets user data form the using the token database and returns it
     *
     * @param Request $request
     * @return Object
     */
    public function getUser(Request $request){
        return User::select('id', 'name', 'email', 'profile_picture','description', 'username')->where("id", $request->id)->where("token", $request->token)->first();
    }
    
    /**
     * getUserData function
     * gets data from the user tabel and returns it
     *
     * @param Request $request
     * @return Object
     */
    public function getUserData(Request $request){
        return User::select('id', 'name','profile_picture','profile_banner','description', 'username')->where("id", $request->id)->first();
    }

    /**
     * test function
     * was a test function to see if the sessions could be called from laravel
     *
     * @param Request $request
     * @return void
     */
    public function test(Request $request){
        dd(session()->all());
    }

    /**
     * logout function
     * gets the user and sets their token to null
     *
     * @param [type] $id
     * @return void
     */
    public function logout($id){
        User::where("id", $id)->update(["token" => null]);
    }
}