<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CardController extends BaseController {

    public function getData() {
        $items = BlogPost::inRandomOrder()->limit(6)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->userID)->select(['id','name'])->first();
            $item->userID = $user;
        }
        return $items;
    }
    
    public function getSmallCardData() {
        $items = BlogPost::inRandomOrder()->limit(4)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->userID)->select(['id','name'])->first();
            $item->userID = $user;
        }
        return $items;
    }
}