<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {

    public function createBlog (Request $request) {
        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        // $file->store("blogImage", 'public');
        // die();
        $file->storeAs("public/blogImage", $name, 'local');
        BlogPost::insert([
            "title" => $request->title,
            "text" => $request->text,
            "img" => $name,
            "user_id" => "1",
        ]);
    }

    public function editBlog(Request $request){
        $oldImg = BlogPost::where('id', $request->id)->first();
        unlink(storage_path('app/public/blogImage/'.$oldImg->img));

        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->storeAs("public/blogImage", $name);
        BlogPost::where('id', $request->id)->update([
            "title" => $request->title,
            "text" => $request->text,
            "img" => $name,
        ]);
    }

    public function deleteBlog($id){
        BlogPost::where('id', $id)->delete($id);
    }
}
