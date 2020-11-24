<?php

namespace App\Http\Controllers;

use App\Article;
use App\Display;
use App\Factories\DisplayFilterFactory;
use App\Factories\PrinterFilterFactory;
use App\Helpers\Productcategory;
use App\Helpers\ProductcategoryConfiguration;
use App\Printer;
use App\Searching\TextSearchField;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        if (mb_strlen(request()->get('search')) < 3) {
            return view('public.search', [
                'minLengthReached' => false
            ]);
        }
        $articles = Article::textSearch(request()->get('search'))->orderBy('published_at', 'desc')->get();
        $printers = Printer::printer()->forSale()->withAttributes()->textSearch(request()->get('search'))->sorted(Printer::SORTING_OPTION_POPULARITY_DOWN)->get();
        $rentals = Printer::printer()->forRent()->withAttributes()->textSearch(request()->get('search'))->sorted(Printer::SORTING_OPTION_POPULARITY_DOWN)->get();
        $displays = Display::withAttributes()->textSearch(request()->get('search'))->sorted(Printer::SORTING_OPTION_POPULARITY_DOWN)->get();
        $printerConfiguration = Productcategory::getConfiguration(Productcategory::PRINTERS_ID);
        $displayConfiguration = Productcategory::getConfiguration(Productcategory::DISPLAYS_ID);
        return view('public.search', [
            'minLengthReached' => true,
            'articles' => $articles,
            'printers' => $printers,
            'rentals' => $rentals,
            'displays' => $displays,
            'printerConfiguration' => $printerConfiguration,
            'displayConfiguration' => $displayConfiguration,
        ]);
    }
}
