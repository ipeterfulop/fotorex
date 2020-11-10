<?php

namespace App\Http\Controllers;

use App\Factories\DisplayFilterFactory;
use App\Factories\PrinterFilterFactory;
use App\Searching\TextSearchField;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $articleFilters = [
            (new TextSearchField())->setLabel('Keresés')->setValue(request()->get('search', ''))->setField('search'),
        ];
        $productFilters = PrinterFilterFactory::createFilters();
        $displayFilters = DisplayFilterFactory::createFilters();
        return view('public.search', [
            'articleFilters' => $articleFilters,
            'productFilters' => $productFilters,
            'displayFilters' => $displayFilters,
        ]);
    }
}
