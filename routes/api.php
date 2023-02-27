<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\loginController;
use App\Http\Controllers\cardController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\blogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [loginController::class, 'checkLogin']);

Route::get("/getCards", [cardController::class, 'getData']);
Route::get("/getCategory", [categoryController::class, 'getData']);

Route::post('/register', [registerController::class, 'registerPerson']);
Route::post('/createBlog', [blogController::class, 'createBlog']);