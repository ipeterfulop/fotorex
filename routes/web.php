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

use App\PrinterPhotoRole;

Route::get('/image', function() {
        echo '<img src="'.\App\Printer::first()->getCustomizedPrinterPhoto(3, PrinterPhotoRole::find(2))->getUrl().'"><hr>';
});

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
    \App\Rentaloption::setVueCRUDRoutes();
    \App\PrinterRentaloption::setVueCRUDRoutes();

    Route::get('/ajax/printer-picker', 'PrinterPickerController@operation')->name('printer_picker_endpoint');
    Route::post('/ajax/related-printer', 'RelatedPrintersController@operation')->name('related_printer_endpoint');
    Route::view('/playground', 'admin.playground');
    Route::post('/ajax/printer-attribute', 'PrinterAttributeController@operation')->name('printer_attribute_endpoints');

});

Route::get('/kapcsolat', 'ContactmessagesController@index')->name('contactmessage_index');
Route::post('/kapcsolat', 'ContactmessagesController@submit')->name('contactmessage_submit');

Route::get('/kereses', 'SearchController@search')->name('search_all');

Route::get('/osszehasonlitas', 'PrinterComparisonController@index')->name('compare_products');
Route::get('/osszehasonlitas/termek', 'PrinterComparisonController@getComparisonData')->name('product_comparison_data');

Route::get('/termekek/kereses', 'PrintersController@printerList')->name('list_printers');

Route::get('/termekek/{slug}', 'PrintersController@details')->name('printer_details');

Route::get('/{categorySlug}', 'ArticlesController@articleList')->name('list_articles');
Route::get('/{categorySlug}/{slug}', 'ArticlesController@show')->name('show_article');
