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

Route::get('/', 'HomeController@index')->name('home');

//Route::auth();
Auth::routes();

//Route::get('/home', 'HomeController@index');
//Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'article'], function() {
    // Article
    Route::get('/{id}', 'ArticleController@detail');
});

Route::group(['prefix' => 'centroid'], function() {
    // Article
    Route::get('/{id}', 'CentroidController@detail');
});



// new layout frontend
Route::group(['prefix' => '2'], function () {

    Route::get('/', 'FrontEnd\FirstController@index');

    // detail article
    Route::group(['prefix' => 'article'], function() {
        Route::get('/{id}', 'FrontEnd\ArticleController@detail');
    });

    // semua berita berdasarkan centroid
    Route::group(['prefix' => 'centroid'], function() {
        Route::get('/{id}', 'FrontEnd\CentroidController@index');

        // centroid -> word_id
    });

    // semua berita berdasarkan feed_id
    Route::group(['prefix' => 'feed'], function() {
        Route::get('/{id}', 'FrontEnd\FeedController@index');

        // feed_id -> centroid_id
        // feed_id -> word_id

    });

    // semua berita berdasarkan word_id
    Route::group(['prefix' => 'word'], function() {
        Route::get('/{id}', 'FrontEnd\WordController@index');

        // word_id -> centroid
    });

    // semua berita yang terbaru pokoknya
    Route::get('/news', 'FrontEnd\FirstController@news');
    
    // semua berita yang popular
    Route::get('/popular', 'FrontEnd\FirstController@popular');

    Route::get('/about', 'FrontEnd\AdditionalController@about');

    Route::get('/search/{page?}', 'FrontEnd\SearchController@result');
});

// admin
Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'admin'], function() {

        // ADMIN
        Route::get('/', 'AdminController@index');

        Route::group(['prefix' => 'feed'], function() {

            // FEEDS
            Route::get('/', 'FeedController@index');
            Route::post('/store', 'FeedController@store');
            Route::post('/destroy', 'FeedController@destroy');

            Route::get('/{id}/article', 'FeedController@detailFeed');
        });


        Route::group(['prefix' => 'article'], function() {
            // ARTICLES
            Route::get('/', 'ArticleController@index');
            Route::get('/data/{feed_id?}', 'ArticleController@getAllData');
            Route::get('/data_bydate/{start}/{end}', 'ArticleController@getCountArticleByDate');
        });

        // CATEGORY
        Route::get('/category', 'CategoryController@index');

        Route::group(['prefix' => 'word'], function() {

            // WORDS
            Route::get('/', 'WordController@index');
            Route::get('/data', 'WordController@getAllData');
            //Route::controller('word', 'WordController', [
            //    'getAllData'  => 'datatables.data',
            //    'getView' => 'backend.view',
            //]);

            Route::post('/store', 'WordController@store');
            Route::get('/edit/{id}', 'WordController@edit');
            Route::post('/update', 'WordController@update');
            Route::post('/destroy', 'WordController@destroy');
        });
    });
});



// SEARCH - Articles
Route::get('/search', 'SearchController@index');
Route::get('/search/result/{page?}', 'SearchController@result');


//Auth::routes();


