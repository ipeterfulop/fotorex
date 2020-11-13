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

//Route::get('/image', function() {
//        echo '<img src="'.\App\Printer::first()->getCustomizedPrinterPhoto(3, PrinterPhotoRole::find(2))->getUrl().'"><hr>';
//});

use App\Scrapers\NewsScraper;

Route::get('/scrape', function() {
    die(htmlentities(NewsScraper::cleanUpHtml('<td valign="top">
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #ff0000; font-weight: bold; font-size: 10pt;">ÜZEMELTETŐ ADATAI, ELÉRHETŐSÉGEK</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;">&nbsp;</p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;">&nbsp;</p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><strong><span style="color: #1d1d1d;"><span style="font-size: 10pt;">FOTOREX Irodatechnika Kft.</span></span></strong></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #1d1d1d;"><span style="font-size: 10pt;">H-1148 Budapest, Lengyel u. 16.<br><br> </span></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Tel.: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 06-1/470-4020</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Fax: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 06-1/470-4021</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">E-mail: </span><a href="mailto:info@fotorex.hu">info@fotorex.hu</a></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;">&nbsp;</p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #1d1d1d;"><span style="font-size: 10pt;">Adószám:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 12190971-2-42</span></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #1d1d1d;"><span style="font-size: 10pt;">Közösségi adószám: HU12190971</span></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #1d1d1d;"><span style="font-size: 10pt;">Cégjegyzékszám: &nbsp; &nbsp; &nbsp;01-09-563487</span></span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Bejegyezte:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fővárosi Bíróság mint Cégbíróság</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Számlavezető:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; K&amp;H Bank Zrt..</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Bankszámla:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10409015-90129986-00000000</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;">&nbsp;</p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Nyitva tartás:</span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;"><span style="color: #000000; font-size: 10pt;">Hétfőtől - Csütörtökig: 08:00 - 16:00<br>Pénteken:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 08:00 - 15:00 </span></p>
<p class="MsoNormal" style="margin: 0cm 0cm 0pt;">&nbsp;</p>
<div style="text-align: justify;"><span style="font-size: 10pt; color: #ff0000; font-weight: bold;">Cégünk nem járul hozzá a fenti elérhetőségek telemarketing, direkt marketing, valamint ügynöki, közvéleménykutatási célú felhasználásához!</span></div>
<p>&nbsp;</p>

</td>')));
});

Route::view('/', 'welcome');

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::view('/', 'admin.welcome');

    \App\User::setVueCRUDRoutes();
    \App\Article::setVueCRUDRoutes();
    \App\Contactmessage::setVueCRUDRoutes();
    \App\Manufacturer::setVueCRUDRoutes();
    \App\ExtraFeature::setVueCRUDRoutes();
    \App\Printer::setVueCRUDRoutes();
    \App\Display::setVueCRUDRoutes();
    \App\Rentaloption::setVueCRUDRoutes();
    \App\PrinterRentaloption::setVueCRUDRoutes();
    \App\Highlightedprinter::setVueCRUDRoutes();
    \App\Highlightedbox::setVueCRUDRoutes();
    \App\Articlecategory::setVueCRUDRoutes();

    Route::get('/ajax/printer-picker', 'PrinterPickerController@operation')->name('printer_picker_endpoint');
    Route::post('/ajax/related-printer', 'RelatedPrintersController@operation')->name('related_printer_endpoint');
    Route::view('/playground', 'admin.playground');
    Route::post('/ajax/printer-attribute', 'PrinterAttributeController@operation')->name('printer_attribute_endpoints');
    Route::post('/ajax/printer-popularity', 'PrinterPopularityIndexController@update')->name('printer_popularity_index_update');
    Route::post('/ajax/printer-rentail-popularity', 'PrinterRentalPopularityIndexController@update')->name('printer_rentaloption_popularity_index_update');

});

Route::get('/kapcsolat', 'ContactmessagesController@index')->name('contactmessage_index');
Route::post('/kapcsolat', 'ContactmessagesController@submit')->name('contactmessage_submit');

Route::post('/ajax/nyomtato-email', 'PrintersController@sendEmail')->name('send_printer_details_in_email');

Route::get('/kereses', 'SearchController@search')->name('search_all');

Route::get('/osszehasonlitas/nyomtatok', 'PrinterComparisonController@index')->name('compare_products');
Route::get('/osszehasonlitas/nyomtatok/termek', 'PrinterComparisonController@getComparisonData')->name('product_comparison_data');
Route::get('/osszehasonlitas/kijelzok', 'DisplayComparisonController@index')->name('compare_displays');
Route::get('/osszehasonlitas/kijelzok/termek', 'DisplayComparisonController@getComparisonData')->name('display_comparison_data');

Route::get('/termekek/nyomtatok/kereses', 'PrintersController@printerList')->name('list_printers');
Route::get('/termekek/kijelzok/kereses', 'DisplaysController@displayList')->name('list_displays');

Route::get('/termekek/kategoriak/{productcategoryId}', 'PrintersController@category')->name('printer_category_index');
Route::get('/termekek/nyomtatok/{slug}', 'PrintersController@details')->name('printer_details');
Route::get('/termekek/kijelzok/{slug}', 'DisplaysController@details')->name('display_details');

Route::get('/termekek/{productcategoryId}/kereses', 'PrintersController@productcategoryList')->name('list_products_in_category');

Route::get('/ajax/cikkek/{categorySlug}', 'ArticlesController@articleListAjax')->name('list_articles_ajax');

Route::get('/{categorySlug}/{subcategorySlug?}', 'ArticlesController@articleList')->name('list_articles');
//Route::get('/{categorySlug}/{slug}', 'ArticlesController@show')->name('show_article');
Route::get('/{categorySlug}/{subcategorySlug?}/{slug?}', 'ArticlesController@show')->name('show_article');
