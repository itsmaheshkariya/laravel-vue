<?php

use Illuminate\Http\Request;


Route::middleware('cors')->group(function(){
Route::get('/','MovieController@getAll');
Route::post('/','MovieController@post');
Route::delete('/{id}','MovieController@delete');
Route::put('/{id}','MovieController@update');
Route::get('/{id}','MovieController@getOne');
});
