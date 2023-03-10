<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
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

Route::get("/getCards/{id}", [CardController::class, 'getCardData']);
Route::get("/getProfileCards/{id}", [CardController::class, 'getProfileCards']);
Route::get("/getCategory", [CategoryController::class, 'getData']);
Route::get("/getAllCategory", [CategoryController::class, 'getAll']);
Route::get("/getSmallCard/{id}", [CardController::class, 'getSmallCardData']);
Route::get("/getComment/{id}/{modifier}", [CommentController::class, 'getData']);
Route::get("/getCommentTotal/{id}", [CommentController::class, 'getCommentTotal']);
Route::get("/allBlogs", [BlogController::class, 'getAllBlogs']);
Route::get("/test", [LoginController::class, 'test']);
Route::get("/obtainBlogpostData/{id}", [BlogController::class, 'obtainBlogpostData']);
Route::get("/getLinkedCategoryBlogpost/{id}", [CategoryController::class, 'getLinkedCategoryBlogpost']);
Route::get("/getSmallCardDataBlogdetail/{id}", [CardController::class, 'getSmallCardDataBlogdetail']);
Route::get("/reloadBlogData/{id}", [CardController::class, 'reloadData']);
Route::get("/getUserData/{id}", [LoginController::class, 'getUserData']);

Route::post('/login', [LoginController::class, 'checkLogin']);
Route::post('/getUser', [LoginController::class, 'getUser']);
Route::post('/register', [RegisterController::class, 'registerPerson']);
Route::post('/createComment', [CommentController::class, 'create']);
Route::post('/createBlog', [BlogController::class, 'createBlog']);
Route::post('/editBlog', [BlogController::class, 'editBlog']);
Route::post('/deleteBlog/{id}', [BlogController::class, 'deleteBlog']);
Route::post('/linkCategoryToBlogpost', [CategoryController::class, 'linkCategoryToPost']);