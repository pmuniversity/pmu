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
Route::get ( '/', function () {
	return view ( 'welcome' );
} );
Route::get ( '/topics/{level}/{slug}', 'Api\TopicsController@show' );
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
	// List topics based on Product types
	Route::get ( 'topics/level/{type}', 'TopicsController@indexByLevel' );
} );