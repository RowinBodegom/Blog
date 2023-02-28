<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\blogpost;
use App\Models\user;
use Illuminate\Http\Request;


class cardController extends BaseController {
    public $blogposts;

    public function __construct(){
        // $this->blogposts = new blogpostModel;
    }

    public function getData() {
        $items = blogpost::inRandomOrder()->limit(6)->get();
        foreach( $items as $item) {
            $user = user::where('id', $item->userID)->select(['id','name'])->first();
            $item->userID = $user;
        }
        return $items;
    }
    public function getSmallCardData() {
        $items = blogpost::inRandomOrder()->limit(4)->get();
        foreach( $items as $item) {
            $user = user::where('id', $item->userID)->select(['id','name'])->first();
            $item->userID = $user;
        }
        return $items;
    }
}