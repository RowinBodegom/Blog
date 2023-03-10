<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Routing\Controller as BaseController;
use App\Models\category_blogPost;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function getData() {
        return Category::inRandomOrder()->limit(5)->get();
    }

    public function getAll() {
        return Category::get();
    }

    public function linkCategoryToPost(Request $request) {
        foreach($request->category as $category){
            $link = new category_blogpost;
            $link->category_id = $category['id'];
            $link->blogpost_id = $request->blogpost_id['data'];
            $link->save();
        }
    }

    public function getLinkedCategoryBlogpost($id) {
        $items = category_blogpost::where('blogpost_id', $id)->select(['category_id'])->get();
        $sendingItems = [];
        foreach($items as $item){
            $categoryname = Category::where('id', $item['category_id'])->select(['name'])->get();
            array_push($sendingItems, $categoryname[0]['name']);
        }
        if($sendingItems){
            return $sendingItems;
        } else {
            return $sendingItems = ["Geen Categorieën"];
        }
    }
}