<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\followers;
use App\Models\User;
use Illuminate\Http\Request;

class followController extends BaseController {
    public function followPerson(Request $request){
        followers::insert($request->all());
    }

    public function unfollowPerson(Request $request){
        followers::where('id', $request->id)->delete();
    }

    public function checkFollow(Request $request){
        $check = followers::where("follower_id", $request->follower_id)->first();
        if($check === null){
            return "follow";
        }
        else{
            return $check;
        }
    }

    public function getFollowers(Request $request){
        return followers::where("followed_id", $request->followed_id)->count();
    }

    public function getFollowed(Request $request){
        return followers::where("follower_id", $request->follower_id)->count();
    }
}