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
/**
 * ! cardcontroller
 */
Route::controller(CardController::class)->group(function () {
    // get
    Route::get("/getCards/{id}",'getCardData');
    Route::get("/getProfileCards/{id}",'getProfileCards');
    Route::get("/getSmallCard/{id}",'getSmallCardData');
    Route::get("/getSmallCardDataBlogdetail/{id}",'getSmallCardDataBlogdetail');
    Route::get("/reloadBlogData/{id}",'reloadData');
});
/**
 * ! CategoryController
 */
Route::controller(CategoryController::class)->group(function () {
    // get
    Route::get("/getCategory", 'getData');
    Route::get("/getAllCategory", 'getAll');
    Route::get("/getLinkedCategoryBlogpost/{id}", 'getLinkedCategoryBlogpost');

    // post
    Route::post('/linkCategoryToBlogpost',  'linkCategoryToPost');
});
/**
 * ! RegisterController
 */
Route::controller(RegisterController::class)->group(function () {
    // post
    Route::post('/register', 'registerPerson');
});
/**
 * ! LoginController
 */
Route::controller(LoginController::class)->group(function () {
    // get
    Route::get("/test", 'test');
    Route::get("/logout/{id}", 'logout');
    Route::get("/getUserData/{id}", 'getUserData');

    // post
    Route::post('/login', 'checkLogin');
    Route::post('/getUser', 'getUser');
});
/**
 * ! BlogController
 */
Route::controller(BlogController::class)->group(function () {
    // get
    Route::get("/allBlogs", 'getAllBlogs');
    Route::get("/obtainBlogpostData/{id}", 'obtainBlogpostData');
    Route::get("/getLengthBlogpostDetails/{id}", 'getLengthBlogpostDetails');
    Route::get("/blogdetail/getContent/{id}", 'blogdetailgetContent');

    // post
    Route::post('/blogbuilder/createElement', 'blogbuilderCreateElement');
    Route::post('/blogbuilder/createElement/img', 'blogbuilderCreateElement_img');
    Route::post('/blogbuilder/createElement/text', 'blogbuilderCreateElement_text');
    Route::post('/editBlog', 'editBlog');
    Route::post('/createBlog', 'createBlog');
    Route::post('/deleteBlog/{id}', 'deleteBlog');

});
/**
 * ! CommentController
 */
Route::controller(CommentController::class)->group(function () {
    // get
    Route::get("/getComment/{id}/{modifier}", 'getData');
    Route::get("/getCommentTotal/{id}", 'getCommentTotal');

    // post
    Route::post('/deleteComment','deleteComment');
    Route::post('/createComment', 'create');
});
