<?php
use Illuminate\Http\Request;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */
DB::listen ( function ($query) {
	/*
	 * dump ( $query->sql );
	 * dump ( $query->bindings );
	 * dump ( $query->time );
	 */
} );
Route::get ( '/user', function (Request $request) {
	return $request->user ();
} )->middleware ( 'auth:api' );

Route::get ( '/topics/{level}', 'Api\TopicsController@index' );
Route::get ( '/articles/{type}', 'Api\TopicsController@indexArticles' );
Route::post ( '/user', 'Api\UsersController@store' );

