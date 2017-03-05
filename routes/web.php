<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
DB::listen(function ($query) {
    // dump ( $query->sql );
    //dump ( $query->bindings );
    // dump ( $query->time );
});
Route::get('/', 'TopicsController@index');

Route::get('/test', function () {
    SSH::get('/pmuniversity.co/config/app.php', 'C:\laragon\www\app.php');
});

// Show login page
Route::get('/' . config('backpack.base.route_prefix', 'admin'), function () {
    if (!Auth::check()) {
        redirect('/' . config('backpack.base.route_prefix', 'admin') . '/login');
    }
});

// Admin routes
Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(['web', 'auth'])->group(function () {
    CRUD::resource('topic', 'Admin\TopicCrudController');
    CRUD::resource('article', 'Admin\ArticleCrudController');
        CRUD::resource('halls-of-knowledge', 'Admin\HallsofKnowledgeCrudController');

    // !!! DIFFERENT ADMIN PANEL FOR USER POSTS
    Route::prefix('topic/search/{topic_id}')->group(function () {
        CRUD::resource('article', 'Admin\TopicArticleCrudController');
    });
    Route::prefix('topic/{topic_id}')->group(function () {
        CRUD::resource('article', 'Admin\TopicArticleCrudController');
    });
});

// Topic details page
Route::get('/{slug}', 'TopicsController@show');
Route::get('/articles/{type}', 'TopicsController@indexArticles');
Route::post ( '/user', 'UsersController@store' );
