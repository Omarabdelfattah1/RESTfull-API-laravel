<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('polls','PollsController@index');
Route::post('polls','PollsController@store');
Route::get('polls/{id}','PollsController@show');
Route::put('polls/{poll}','PollsController@update');
Route::delete('polls/{poll}','PollsController@destroy');
Route::get('polls/{poll}/questions','PollsController@Questions');
Route::any('errors','PollsController@errors');
Route::apiResource('questions','QuestionsController');
Route::get('/download','DownloadController@show');
Route::post('/upload','DownloadController@create');
