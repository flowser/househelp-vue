<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Religion;

class ReligionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religion::create(['name'  => 'Christian',]);
        Religion::create(['name'  => 'Muslim',]);
        Religion::create(['name'  => 'Hindu',]);
        Religion::create(['name'  => 'Others',]);
    }
}
