<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User as userModel;
use Illuminate\Http\Request;


class blogController extends BaseController {

    public function createBlog (Request $request) {
        userModel::create($request->all());
    }
}