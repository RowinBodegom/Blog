<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function getData() {
        $items = category::inRandomOrder()->limit(5)->get();
        return $items;
    }
}