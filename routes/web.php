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
    \App\Contactmessage::setVueCRUDRoutes();
    \App\Manufacturer::setVueCRUDRoutes();
    \App\ExtraFeature::setVueCRUDRoutes();
    \App\Printer::setVueCRUDRoutes();

});

Route::view('/kapcsolat', 'public.contactmessages.index')->name('contactmessage_index');
Route::post('/kapcsolat', 'ContactmessagesController@submit')->name('contactmessage_submit');

Route::get('/{categorySlug}/{page?}', 'ArticlesController@articleList')->name('list_articles');
