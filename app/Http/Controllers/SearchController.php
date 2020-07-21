<?php

namespace App\Http\Controllers;

use App\Searching\TextSearchField;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        $articleFilters = [
            (new TextSearchField())->setLabel('Keresés')->setValue(request()->get('search', ''))->setField('search'),
        ];
        $productFilters = [];
        return view('public.search', [
            'articleFilters' => $articleFilters,
            'productFilters' => $productFilters,
        ]);
    }
}
