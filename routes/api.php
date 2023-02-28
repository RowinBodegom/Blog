<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BlogController;

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

Route::post('/login', [LoginController::class, 'checkLogin']);

Route::get("/getCards", [CardController::class, 'getData']);
Route::get("/getCategory", [CategoryController::class, 'getData']);
Route::get("/getSmallCard", [CardController::class, 'getSmallCardData']);

Route::post('/register', [RegisterController::class, 'registerPerson']);
Route::post('/createBlog', [BlogController::class, 'createBlog']);
Route::post('/createBlogImg', [BlogController::class, 'createBlogImg']);