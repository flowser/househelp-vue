<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Kid;

class KidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kid::create(['name'  => 'with kids',]);
        Kid::create(['name'  => 'no kids',]);
    }
}
