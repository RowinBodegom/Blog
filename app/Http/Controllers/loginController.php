<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class loginController extends BaseController {

    public function someMethod (Request $request) {
        dd($request->all());
    }
}