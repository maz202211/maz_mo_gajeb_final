<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
// 





Route::get('authers', 'App\Http\Controllers\Api\users_controller@index');
Route::get('authers/{id}', 'App\Http\Controllers\Api\users_controller@show');
Route::get('post/authers/{id}', 'App\Http\Controllers\Api\users_controller@auther_post');
Route::get('comments/auther/{id}', 'App\Http\Controllers\Api\users_controller@auther_comments');




/*  categories reloud*/
Route::get('categories', 'App\Http\Controllers\Api\categories_controller@index');
Route::get('post/categories/{id}', 'App\Http\Controllers\Api\categories_controller@categorispost');

// 
// /*  posts reloud*/
Route::get('posts/', 'App\Http\Controllers\Api\posts_controller@index');
Route::get('post/{id}', 'App\Http\Controllers\Api\posts_controller@show');

// 
// /*  comments reloud*/
Route::get('/comments', 'App\Http\Controllers\Api\comments_controller@index');
Route::get('/comment/post/{id}', 'App\Http\Controllers\Api\comments_controller@show');
// 


route::post('token', 'App\Http\Controllers\Api\users_controller@get_token');
route::post('regester', 'App\Http\Controllers\Api\users_controller@store');
Route::post('update_user/{id}', 'App\Http\Controllers\Api\users_controller@update');


Route::post('posts/', 'App\Http\Controllers\Api\posts_controller@store');
Route::post('update_posts/{id}', 'App\Http\Controllers\Api\posts_controller@update');
Route::delete('delete_post/{id}', 'App\Http\Controllers\Api\posts_controller@destroy');

Route::post('/add_comment/{id}', 'App\Http\Controllers\Api\comments_controller@store');
route::post('votes/posts/{id}', 'App\Http\Controllers\Api\posts_controller@votes');

Route::middleware('Auth::guard(token_name)')->get('/usersss', 'App\Http\Controllers\Api\comments_controller@index');
