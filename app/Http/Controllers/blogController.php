<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\blogpostDetails;
use App\Models\blogpostDetails_img;
use App\Models\blogpostDetails_text;
use Illuminate\Support\Facades\Storage;
use file;
use Illuminate\Http\Request;

class BlogController extends BaseController {
    /**
     * !this is for the general blog data
     */
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
    /**
     * ! these functions are for the blogdetail page alone
     */
    public function blogdetailgetContent($id){
        $content = blogpostDetails::where('blogpost_id', $id)->get();
        foreach( $content as $item) {
            if($item->type == 'afbeelding' || $item->type == 'diavoorstelling'){
                $images = blogpostDetails_img::where('blogdetail_id', $item->id)->select('id','img')->get();
                $item->data = $images;
            } else if ($item->type == 'met' || $item->type == 'zonder') {
                $text = blogpostDetails_text::where('blogdetail_id', $item->id)->select('id','title', 'text')->get();
                $item->data = $text;
            }
        }
        return $content;
    }

    public function blogdetailupdateElement_text(Request $request){
        blogpostDetails_text::where('id', $request->id)->update([
            "title" => $request->title,
            "text" => $request->text,
        ]);
    }
    /**
     * ! the functions below are for the blogdetailbuilder feature
     */
    public function getLengthBlogpostDetails($id){
        $item = blogpostDetails::where('blogpost_id', $id)->get();
        return count($item);
    }

    public function blogbuilderCreateElement(Request $request){
        $blogdetail = new blogpostDetails;
        $blogdetail->blogpost_id = $request->blogpost_id;
        $blogdetail->position = $request->position;
        $blogdetail->type = $request->type;
        $blogdetail->save();

        return $blogdetail->id;
    }

    public function blogbuilderCreateElement_img(Request $request){
        $blogdetail = new blogpostDetails_img;

        $file = $request->file('img');
        $name = time() . "_" . $request->img->getClientOriginalName();
        $file->storeAs("public/blogImage", $name, 'local');
        $blogdetail->img = $name;
        
        $blogdetail->blogdetail_id = $request->blogdetail_id;
        $blogdetail->save();
    }

    public function blogbuilderCreateElement_text(Request $request){
        $blogdetail = new blogpostDetails_text;
        $blogdetail->blogdetail_id = $request->blogdetail_id;
        $blogdetail->title = $request->title;
        $blogdetail->text = $request->text;
        $blogdetail->save();

        return $blogdetail->id;
    }
}
