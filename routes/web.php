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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::view('/', 'admin.welcome');

    \App\User::setVueCRUDRoutes();
    \App\Article::setVueCRUDRoutes();

});

Route::get('/cikkek', 'ArticlesController@redirectToLatest')->name('articles_redirect_to_latest');
Route::get('/cikkek/{sortingOption}/{page?}', 'ArticlesController@index')->name('articles_index');
Route::get(\App\Article::SLUG_BASE.'{slug}', 'ArticlesController@show')->name('article_details');
