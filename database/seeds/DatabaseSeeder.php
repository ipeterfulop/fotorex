<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddDefaultUsers::class);
        $this->call(ArticlecategoriesSeeder::class);
        $this->call(MenuitemsSeeder::class);
        $this->call(PopulateExtraFeaturesTable::class);
        $this->call(PopulateUsergroupSizesTable::class);
        $this->call(PopulatePapersizesTable::class);
        $this->call(PopulateAttributeSetsTable::class);
        $this->call(PopulateAttributeValuesTable::class);
        $this->call(PopulateAttributegroupsTable::class);
        $this->call(PopulateAttributesTable::class);
        $this->call(SlidersSeeder::class);
        $this->call(ScrapedNewsSeeder::class);
        $this->call(ServicesArticlesSeeder::class);

        $this->call(PopulateManufacturersTable::class);
    }
}
