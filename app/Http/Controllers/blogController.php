<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use App\Models\category_blogPost;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {

    public function createBlog (Request $request) {
        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->storeAs("public/blogImage", $name, 'local');
        $blog = new BlogPost;
        $blog->title = $request->title;
        $blog->text = $request->text;
        $blog->img = $name;
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

    public function linkCategoryToPost(Request $request){
        // dd($request->category);
        foreach($request->category as $category){
            $link = new category_blogpost;
            $link->category_id = $category['id'];
            $link->blogpost_id = $request->blogpost_id['data'];
            $link->save();
        }
    }
}
