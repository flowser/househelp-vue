<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Tribe;

class TribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tribe::create(['name'  => 'Borana',]);
        Tribe::create(['name'  => 'Giriama',]);
        Tribe::create(['name'  => 'Kalenjin',]);
        Tribe::create(['name'  => 'Kamba',]);
        Tribe::create(['name'  => 'Kikuyu',]);
        Tribe::create(['name'  => 'Kisii',]);
        Tribe::create(['name'  => 'Kuria',]);
        Tribe::create(['name'  => 'Luhya',]);
        Tribe::create(['name'  => 'Luo',]);
        Tribe::create(['name'  => 'Maasai',]);
        Tribe::create(['name'  => 'Meru',]);
        Tribe::create(['name'  => 'Somali',]);
        Tribe::create(['name'  => 'Swahili',]);
        Tribe::create(['name'  => 'Taita',]);
        Tribe::create(['name'  => 'Teso',]);
        Tribe::create(['name'  => 'Turkana',]);
    }
}
