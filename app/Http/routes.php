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

/*use Illuminate\Support\Facades\Auth;

                // Получить текущего аутентифицированного пользователя...
$user = Auth::user();

                // Получить ID текущего аутентифицированного пользователя...
$id = Auth::id();

if($id == ""){
    Route::get('/', function () {
        return view('auth');
    });
}
else{
    Route::get('auth', function () {
        return view('auth');
    });

    Route::get('/', function () {
        return view('welcome');
    });
}*/

Route::auth();

//Route::post('/sendMessage', 'Message\MessageController@sendMessage');

Route::post('/sendMessage','AjaxController@sendMessage');

Route::get('/userChats/{userId}','ShowUserChatsController@show');


/*Route::get('/', function () {
    return view('main');
});*/

Route::get('/', 'HomeControllerMy@show');

Route::get('/chat/{userIDOther}/{userID}', 'ChatController@show');
Route::get('/chat/{userIDOther}', 'ChatController@show');

Route::get('/delete/{userId}', 'DeleteUserController@deleteUser');





/*Route::post('/task', function (Request $request) {

});

Route::delete('/task/{task}', function (Task $task) {
    
});




Route::get('/home', 'HomeController@index');*/
