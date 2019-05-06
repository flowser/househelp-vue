<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Experience;

class ExperienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Experience::create(['name'  => '0 years',]);
        Experience::create(['name'  => '1-3 years',]);
        Experience::create(['name'  => '4-6 years',]);
        Experience::create(['name'  => '7-9 years',]);
        Experience::create(['name'  => '10-12 years',]);
        Experience::create(['name'  => '13-16 years',]);
        Experience::create(['name'  => '17-21 years',]);
    }
}
