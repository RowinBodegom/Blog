<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends BaseController {

    public function create (Request $request) {
        Comment::insert(
            [
                "text" => $request->text,
                "user_id" => $request->user_id,
                "blogpost_id" => $request->blogpost_id,
            ]
        );
    }

    public function getData ($id) {
        $items = Comment::where('blogpost_id', $id)->limit(3)->get();
        foreach( $items as $item) {
            $user = User::where('id', $item->user_id)->select(['profile_picture','name'])->first();
            $item->user_id = $user;
        }
        return $items;
    }

    public function deleteComment(Request $request){
        Comment::where('id', $request->comment_id)->delete($request->comment_id);
    }
}