<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('posts',[PostController::class,'index']);

// secure routes 
Route::controller(PostController::class)
->middleware('auth')
->group(function(){

    Route::post('createpost','createPost');
    Route::put('updatepost/{id}','updatePost');
    Route::delete('posts/{id}','deletePost');
    

});

Route::post('logout',[UserController::class,'logout'])->middleware('auth');

Route::controller(UserController::class)->group(function(){
    
    Route::post('register','register');
    Route::post('login','login');
    
});
