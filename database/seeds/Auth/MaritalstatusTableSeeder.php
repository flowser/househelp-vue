<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Maritalstatus;

class MaritalstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maritalstatus::create(['name'  => 'married',]);
        Maritalstatus::create(['name'  => 'Not married',]);
        Maritalstatus::create(['name'  => 'deforced',]);
    }
}
