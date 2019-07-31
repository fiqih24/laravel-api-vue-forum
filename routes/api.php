<?php

use Illuminate\Http\Request;
use App\User;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource('/question','QuestionController');
Route::apiResource('/category','CategoryController');
Route::apiResource('/question/{question}/reply','ReplyController');
// Route::get('/question/{question}/reply/{reply}','ReplyController@show');

Route::post('/like/{reply}','LikeController@LikeIt');
Route::delete('/unlike/{reply}','LikeController@unLikeIt');
Route::get('/showlike/{reply}','LikeController@countLike');
Route::get('/check_like/{reply}','LikeController@check_like');

Route::get("/notifications", function(){
  return [
    'read'=>user::find(11)->readNotifications(),
    'unread'=>user::find(11)->unReadNotifications(),
  ];
});

Route::get("/websocket",function(){
    return 'okay';
});
Route::post("/websocket",function(){
    return 'okay';
});

Route::group([
    'prefix' => 'auth'

], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
    Route::post('signup', 'AuthController@signup');

});
