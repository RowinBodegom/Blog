<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost as blogModel;
use Storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {

    public function createBlog (Request $request) {
        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->storeAs("public/blogImage", $name);
        blogModel::insert([
            "title" => $request->title,
            "text" => $request->text,
            "img" => $name,
            "userID" => "1",
        ]);
    }

    public function editBlog(Request $request){
        $oldImg = blogModel::where('id', $request->id)->first();
        unlink(storage_path('app/public/blogImage/'.$oldImg->img));

        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->storeAs("public/blogImage", $name);
        blogModel::where('id', $request->id)->update([
            "title" => $request->title,
            "text" => $request->text,
            "img" => $name,
        ]);
    }

    public function deleteBlog($id){
        blogModel::where('id', $id)->delete($id);
    }
}