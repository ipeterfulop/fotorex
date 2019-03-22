<?php
namespace App\Factories;

class ArticleMenuFactory
{
    public static function generateMenuitems()
    {
        $categories = \App\Articlecategory::where('show_in_main_menu', '=', 1)
            ->orderBy('position', 'asc')
            ->with(['articles'])
            ->get();

        return $categories;
    }
}