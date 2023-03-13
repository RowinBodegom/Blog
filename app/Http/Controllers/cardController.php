<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CardController extends BaseController{

    public function getData($amount, $id){
        $items = BlogPost::where('user_id', "!=", $id)->inRandomOrder()->limit($amount)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->user_id)->select(['id','name'])->first();
            $item->user_id = $user;
        }
        return $items;
    }

    public function getCardData($id){
        return $this->getData(6, $id);
    }

    public function getSmallCardData($id){
        return $this->getData(4, $id);
    }

    public function getProfileCards($id){
        $items = BlogPost::where('user_id', $id)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->user_id)->select(['id','name'])->first();
            $item->user_id = $user;
        }
        return $items;
    }

    public function getSmallCardDataBlogdetail($id) {
        $items = BlogPost::where('user_id', $id)->inRandomOrder()->limit(4)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->user_id)->select(['id','name'])->first();
            $item->user_id = $user;
        }
        return $items;
    }

    public function reloadData($id) {
        $item = BlogPost::where('id', $id)->first();
        $user = User::where('id', $item->user_id)->select(['id','name'])->first();
        $item->user_id = $user;
        return $item;
    }
}