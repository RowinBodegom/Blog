<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getData() {
        return Category::inRandomOrder()->limit(5)->get();
    }

    public function getAll() {
        return Category::get();
    }
}