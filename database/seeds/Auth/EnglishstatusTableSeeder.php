<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Englishstatus;

class EnglishstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Englishstatus::create(['name'  => 'Yes',]);
        Englishstatus::create(['name'  => 'No',]);
        Englishstatus::create(['name'  => 'Slightly',]);
    }
}
