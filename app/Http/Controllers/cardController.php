<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CardController extends BaseController {

    public function getData($amount) {
        $items = BlogPost::inRandomOrder()->limit($amount)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->user_id)->select(['id','name'])->first();
            $item->user_id = $user;
        }
        return $items;
    }
    
    public function getCardData(){
        return $this->getData(6);
    }

    public function getSmallCardData() {
        return $this->getData(4);
    }
}