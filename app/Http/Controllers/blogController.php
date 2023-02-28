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
        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->move(public_path("../resources/images"), $name);
        blogModel::insert(
            [
                "title" => "fjhtujhgsbjhytfesfe",
                "text" => "gtfrgejhitt",
                "userID" => "1",
                "img" => $name,
            ]
        );
    }
}