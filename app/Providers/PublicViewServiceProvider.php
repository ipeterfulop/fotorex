<?php

namespace App\Providers;

use App\Articlecategory;
use App\Highlightedprinter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PublicViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            return $view->with('highlightedprinters', Highlightedprinter::orderBy('position', 'asc')->get())
                ->with('publicmenuitems', $this->buildPublicMenu())
                ->with('solutions', $this->getSolutionSubcategories());
        });
    }

    protected function getSolutionSubcategories()
    {
        return Articlecategory::findBySlug('megoldasok')->subcategories;
    }

    protected function buildPublicMenu()
    {
        return [
            'Nyomtatók' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::PRINTERS_ID]),
            'Multifunkciós nyomtatók' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::MFP_ID]),
            'Nyomtatóbérlés' => '#',
            'Interaktív monitorok' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::DISPLAYS_ID]),
            'Irodaszerek' => 'https://webaruhaz.fotorex.hu/',
        ];
    }
}
