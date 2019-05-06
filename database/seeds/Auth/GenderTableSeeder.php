<?php

use App\Models\Standard\Gender;
use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create(['name' => 'Male']);
        Gender::create(['name' => 'Female']);
    }
}
