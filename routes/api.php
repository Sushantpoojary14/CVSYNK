<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/',function(){
    return "hello";
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::middleware('auth')->group(function () {
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });


});

Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/all_posts/{start?}/{end?}', 'getAllPosts');
    Route::get('/all_filter_details', 'getAllFilterDetails');
    Route::post('/filter_posts', 'getPostsByFilter');
    Route::get('/search_posts/{search}', 'getPostsByFilter');

    Route::middleware('auth')->group(function () {
        Route::post('/apply_job_post', 'applyJobPost');
        Route::get('/get_applied_job_post/{id}', 'getUserJobPost');
        Route::get('/all_user_posts/{user_id}/{start?}/{end?}', 'getAllUserPosts');
        Route::get('/get_user_apply/{user_id}/{start}/{end}', 'getAllUserApplied');
        Route::post('/add_user_posts', 'addJobPost');
    });


});

