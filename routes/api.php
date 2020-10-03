<?php


Route::apiResource('/question','QuestionController');

Route::apiResource('/category','CategoryController');

Route::apiResource('/question/{question}/reply','ReplyController');

Route::post('/like/{reply}','LikeController@likeReply');
Route::delete('/unlike/{reply}','LikeController@unLikeReply');

Route::post('/login', 'AuthController@login');
Route::post('/signup', 'AuthController@signup');
Route::post('/logout', 'AuthController@logout');
Route::post('/refresh', 'AuthController@refresh');
Route::post('/me', 'AuthController@me');

Route::get('/notifications','NotificationController@index');
Route::put('/notification/markAsRead','NotificationController@markAsRead');

