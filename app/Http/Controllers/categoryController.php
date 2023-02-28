<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function getData() {
        return category::inRandomOrder()->limit(5)->get();
    }
}