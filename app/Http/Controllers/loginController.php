<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\User as userModel;
use Illuminate\Http\Request;


class loginController extends BaseController {
    public $user;

    public function __construct(){
        $this->user = new userModel;
    }

    public function checkLogin (Request $request) {
        // var_dump($this->user::find(1)->where('name', 'rowin')->get());
        if($request){
            $username = $request->username;
            $password = $request->password;
            
            $foundUsers = $this->user::all()->where('name', $username)->toArray();
            if ($foundUsers) {
                var_dump($foundUsers);
                echo " user found ";
            } else {
                var_dump($foundUsers);
                echo  " no user can be found ";
            }
        }
        

        

        
        // $password = $request->password;
        // var_dump($password);
    }
}