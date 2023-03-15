<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\blogpostDetails;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {

    public function createBlog (Request $request) {
        $blog = new BlogPost;
        if($request->img !== null){
            $file = $request->file('img');
            $name = time() . "_" . $request->img->getClientOriginalName();
            $file->storeAs("public/blogImage", $name, 'local');
            $blog->img = $name;
        } else {
            $blog->img = null;
        }
        $blog->title = $request->title;
        $blog->text = $request->text;
        $blog->user_id = 1;
        $blog->save();
        return $blog->id;
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

    public function obtainBlogpostData($id){
        $item = BlogPost::where('id', $id)->first();
        $user = User::where('id', $item->user_id)->select(['id','name', 'profile_picture'])->first();
        $item->user_id = $user;
        return $item;
    }

    public function getLengthBlogpostDetails($id){
        $item = blogpostDetails::where('id', $id)->get();
        return count($item);
    }
}
