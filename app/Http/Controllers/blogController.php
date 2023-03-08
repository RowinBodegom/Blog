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
        $file->storeAs("public/blogImage", $name, 'local');
        BlogPost::insert([
            "title" => $request->title,
            "text" => $request->text,
            "img" => $name,
            "user_id" => "1",
        ]);
    }

    public function editBlog(Request $request){
        $file = $request->file('img');
        $oldImg = BlogPost::where('id', $request->id)->first();
        if($file){
            if($oldImg->img){
                unlink(storage_path('app/public/blogImage/'.$oldImg->img));
            }
            $name = time() . "_" . $request->img->getClientOriginalName();
            $file->storeAs("public/blogImage", $name);
            BlogPost::where('id', $request->id)->update([
                "title" => $request->title,
                "text" => $request->text,
                "img" => $name,
            ]);
        } else {
            BlogPost::where('id', $request->id)->update([
                "title" => $request->title,
                "text" => $request->text,
            ]);
        }
    }

    public function deleteBlog($id){
        BlogPost::where('id', $id)->delete($id);
    }
}
