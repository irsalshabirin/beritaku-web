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

Route::group(['prefix' => 'article'], function () {
   
    // get one article
    Route::get('/{id}', 'Api\ArticleController@get');

});

Route::group(['prefix' => 'centroid'], function () {
   
    // get all centroid
    Route::get('/', 'Api\CentroidController@index');

});