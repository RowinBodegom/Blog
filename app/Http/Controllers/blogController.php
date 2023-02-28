<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\blogpost as blogModel;
use storage;
use file;
use Illuminate\Http\Request;

class blogController extends BaseController {

    public function createBlog (Request $request) {
        blogModel::insert(
            [
                "title" => $request->title,
                "text" => $request->text,
                "userID" => "1"
            ]
        );
    }

    public function createBlogImg(Request $request){
        $name = time() . "_" . $request->img->getClientOriginalName();
    }
}