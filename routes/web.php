<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | This file is where you may define all of the routes that are handled
 * | by your application. Just tell Laravel the URIs it should respond
 * | to using a Closure or controller method. Build something great!
 * |
 */
Route::get ( '/', 'TopicsController@index' );

Route::get ( 'confirm/{token}', 'Auth\RegisterController@confirm' );

Auth::routes ();
Route::post ( 'image', 'FileController@store' ); // Save image

/*
 * |--------------------------------------------------------------------------
 * | Admin Routes
 * |--------------------------------------------------------------------------
 * |
 * | This file is where you may define all of the routes that are handled
 * | by your application. Just tell Laravel the URIs it should respond
 * | to using a Closure or controller method. Build something great!
 * |
 */
Route::group ( [ 
		'prefix' => 'admin',
		'namespace' => 'Admin' 
], function () {
	Route::get ( '/', 'HomeController@index' );
	Route::get ( 'users', 'UsersController@index' );
	Route::post ( '/datatable-users', 'UsersController@ajaxIndex' );
	// Topics Route
	Route::resource ( 'topics', 'TopicsController' );
	Route::post ( '/datatable-topics', 'TopicsController@ajaxIndex' );
	Route::post ( '/datatable-topics-by-level', 'TopicsController@ajaxIndexByLevel' );
	// Article Route
	Route::resource ( 'articles', 'ArticleController' );
	Route::post ( '/datatable-articles', 'ArticleController@ajaxIndex' );
	Route::post ( '/dtable-articles-by-type', 'ArticleController@ajaxIndexByType' );
	// List topics based on Product types
	Route::get ( 'topics/level/{type}', 'TopicsController@indexByLevel' );
	Route::get ( 'artcles-by-type/{type}/{topicId}', 'ArticleController@indexByType' );
} );

// Topic details page
Route::get ( '/{slug}', 'Api\TopicsController@show' );