<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddDefaultUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::updateOrCreate(
            [
            'id' => 1
            ],
            [
                'id' => 1,
                'name' => 'Datalytix Developer',
                'email' => 'developer@datalytix.solutions',
                'password' => bcrypt('a1b2c7')
            ]
        );
        \App\User::updateOrCreate(
            [
            'id' => 2
            ],
            [
                'id' => 2,
                'name' => 'Fülöp Péter',
                'email' => 'fulop.peter@datalytix.tech',
                'password' => bcrypt('a1b2c7')
            ]
        );
        \App\User::updateOrCreate(
            [
                'id' => 3
            ],
            [
                'id' => 3,
                'name' => 'Toth Jani',
                'email' => 'janikukac@gmail.com',
                'password' => bcrypt('Jani123')
            ]
        );
    }
}
