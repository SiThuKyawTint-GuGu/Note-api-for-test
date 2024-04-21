<?php

use App\Http\Controllers\AuthApi;
use App\Http\Controllers\CategoryApi;
use App\Http\Controllers\NoteApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login',[AuthApi::class,'login']);
Route::post('/register',[AuthApi::class,'register']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApi::class, 'logout']);
    Route::resource('category', CategoryApi::class);

    Route::resource('note',NoteApi::class);
    Route::post('fav-note/add',[NoteApi::class, 'addFav']);
    Route::delete('fav-note/remove', [NoteApi::class, 'removeFav']);
    Route::get('fav-note/get',[NoteApi::class, 'getFav']);

    Route::get('/search/user', [NoteApi::class, 'searchUser']);
    Route::post('contribute-note/create', [NoteApi::class, 'createContribute']);
    Route::get('contribute-note/get', [NoteApi::class, 'getContribute']);
    Route::get('receive-note/get', [NoteApi::class, 'getReceiveNote']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
