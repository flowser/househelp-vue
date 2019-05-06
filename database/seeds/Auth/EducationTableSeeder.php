<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Education;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Education::create(['name'  => 'Primary',]);
        Education::create(['name'  => 'Secondary',]);
        Education::create(['name'  => 'College',]);
        Education::create(['name'  => 'University',]);
    }
}
