<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::post('/sendMessage','AjaxController@sendMessage');

Route::get('/userChats/{userId}','ShowUserChatsController@show');


Route::get('/', 'HomeControllerMy@show');

Route::get('/chat/{userIDOther}/{userID}', 'ChatController@show');
Route::get('/chat/{userIDOther}', 'ChatController@show');

Route::get('/delete/{userId}', 'DeleteUserController@deleteUser');


