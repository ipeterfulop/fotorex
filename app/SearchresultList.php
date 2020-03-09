<?php


namespace App;


class SearchresultList
{
    public $articles;
    public $products;

    public function __construct()
    {
        $this->articles = collect([]);
        $this->products = collect([]);
    }
}
