<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends BaseController {

    public function editUser(Request $request){
        $user = User::where('id', $request->id)->first();
        $profilePictureName = null;
        $bannerName = null;
        if($request->profilePicture !== null){
            if($user->profile_picture !== null){
                unlink(storage_path('app/public/profilePicture/'.$user->profile_picture));
            }
            $file = $request->file('profilePicture');
            $profilePictureName = time() . "_" . $request->profilePicture->getClientOriginalName();
            $file->storeAs("public/profilePicture", $profilePictureName, 'local');
        }
        if($request->banner !== null){
            if($user->profile_banner !== null){
                unlink(storage_path('app/public/banner/'.$user->profile_banner));
            }
            $file = $request->file('banner');
            $bannerName = time() . "_" . $request->profilePicture->getClientOriginalName();
            $file->storeAs("public/banner", $bannerName, 'local');
        }
        $request['password'] = Hash::make($request['password']);
        User::where('id', $request->id)->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "profile_picture" => $profilePictureName,
            "profile_banner" => $bannerName,
        ]);
        return response()->json([
            "userID" => $request->id,
            'name' => $request->name,
            'mail' => $request->email,
            'profile_picture' => $profilePictureName,
            'profile_banner' => $bannerName,
        ]);
    }
}