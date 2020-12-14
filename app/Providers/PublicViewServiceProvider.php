<?php

namespace App\Providers;

use App\Article;
use App\Articlecategory;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
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
                ->with('privacyArticleUrl', $this->getPrivacyArticleUrl())
                ->with('solutions', $this->getSolutionSubcategories());
        });
    }

    protected function getPrivacyArticleUrl()
    {
        return optional(Article::findBySlug('adatvedelem-es-jog', false))->url;
    }

    protected function getSolutionSubcategories()
    {
        return Articlecategory::findBySlug('megoldasok')->subcategories;
    }

    protected function buildPublicMenu()
    {
        return [
            Productcategory::PRINTERS_LABEL => ['target' => '_self', 'url' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::PRINTERS_ID])],
            Productcategory::MFP_LABEL => ['target' => '_self', 'url' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::MFP_ID])],
            Productcategory::RENTALS_LABEL => ['target' => '_self', 'url' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::RENTALS_ID])],
            Productcategory::DISPLAYS_LABEL => ['target' => '_self', 'url' => route('printer_category_index', ['productcategoryId' => \App\Helpers\Productcategory::DISPLAYS_ID])],
            'Irodaszerek' => ['target' => '_blank', 'url' => 'https://webaruhaz.fotorex.hu/'],
        ];
    }
}
