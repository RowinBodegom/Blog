<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {

    public function createBlog (Request $request) {
        BlogPost::insert(
            [
                "title" => $request->title,
                "text" => $request->text,
                "userID" => "1"
            ]
        );
    }
    
    public function createBlogImg(Request $request){
        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->move(public_path("../resources/images"), $name);
        BlogPost::insert(
            [
                "title" => "fjhtujhgsbjhytfesfe",
                "text" => "gtfrgejhitt",
                "userID" => "1",
                "img" => $name,
            ]
        );
    }
}