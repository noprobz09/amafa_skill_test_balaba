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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'person'], function () { 

    Route::get('/lists', 'Api\PersonController@lists')->name('api.person.lists');
    Route::post('/add', 'Api\PersonController@add')->name('api.person.add');
    Route::patch('/update', 'Api\PersonController@add')->name('api.person.update');
    Route::get('/view/{id}', 'Api\PersonController@view')->name('api.person.view');
    Route::delete('/delete/{id}', 'Api\PersonController@delete')->name('api.person.delete');
    
});