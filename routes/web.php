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
Route::get('/scrape', function() {
    if (file_exists(storage_path('app/scrape.ser'))) {
        $data = unserialize(file_get_contents(storage_path('app/scrape.ser')));
    } else {
        $data = \App\Scrapers\SharpScraper::scrapeProductPage('https://www.sharp.hu/cps/rde/xchg/hu/hs.xsl/-/html/product-details-office-print.htm?product=MX6071');
        file_put_contents(storage_path('app/scrape.ser'), serialize($data));
    }
    dump($data);
    $sdata = \App\Scrapers\SharpScraper::parseScrapedData($data);
    \App\PrinterAttribute::updateOrCreate([
        'printer_id' => 66,
        'attribute_id' => 26,
        ], ['customvalue' => $sdata['attributes']['tsp_general']]
    );
    dd($sdata);
});
Route::view('/', 'welcome');

Route::view('/migration', 'OldDataMigrationController@index');


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
    \App\Slider::setVueCRUDRoutes();
    \App\Slide::setVueCRUDRoutes();

    Route::get('/ajax/printer-picker', 'PrinterPickerController@operation')->name('printer_picker_endpoint');
    Route::post('/ajax/related-printer', 'RelatedPrintersController@operation')->name('related_printer_endpoint');
    Route::view('/playground', 'admin.playground');
    Route::post('/ajax/printer-attribute', 'PrinterAttributeController@operation')->name('printer_attribute_endpoints');
    Route::post('/ajax/printer-popularity', 'PrinterPopularityIndexController@update')->name('printer_popularity_index_update');
    Route::post('/ajax/printer-rentail-popularity', 'PrinterRentalPopularityIndexController@update')->name('printer_rentaloption_popularity_index_update');

});

Route::get('/kapcsolat', 'ContactmessagesController@index')->name('contactmessage_index');
Route::middleware(['throttle:contacts'])->group(function() {
    Route::post('/kapcsolat', 'ContactmessagesController@submit')->name('contactmessage_submit');
    Route::post('/ajax/nyomtato-email', 'PrintersController@sendEmail')->name('send_printer_details_in_email');
});

Route::get('/kereses', 'SearchController@search')->name('search_all');

Route::get('/osszehasonlitas/nyomtatok', 'PrinterComparisonController@index')->name('compare_products');
Route::get('/osszehasonlitas/nyomtatok/termek', 'PrinterComparisonController@getComparisonData')->name('product_comparison_data');
Route::get('/osszehasonlitas/kijelzok', 'DisplayComparisonController@index')->name('compare_displays');
Route::get('/osszehasonlitas/kijelzok/termek', 'DisplayComparisonController@getComparisonData')->name('display_comparison_data');

Route::get('/termekek/{productcategoryId}/kereses', 'ProductController@productcategoryList')->name('list_products_in_category');

Route::get('/termekek/kategoriak/{productcategoryId}', 'PrintersController@category')->name('printer_category_index');

//Route::get('/termekek/multifunkcios-nyomtatok/{slug}', 'PrintersController@details')->name('mfc_details');
//Route::get('/termekek/nyomtatok/{slug}', 'PrintersController@details')->name('printer_details');
//Route::get('/termekek/kijelzok/{slug}', 'DisplaysController@details')->name('display_details');
Route::get('/termekek/{familyslug}/{slug}', 'ProductController@categoryDetails')->name('category_details');

Route::post('/ajax/pdf/{slug}', 'PdfController@export')->name('print_to_pdf');

Route::get('/ajax/cikkek/{categorySlug}', 'ArticlesController@articleListAjax')->name('list_articles_ajax');

Route::get('/{categorySlug}/{subcategorySlug?}', 'ArticlesController@articleList')->name('list_articles');
Route::get('/{categorySlug}/{subcategorySlug?}/{slug?}', 'ArticlesController@show')->name('show_article');
