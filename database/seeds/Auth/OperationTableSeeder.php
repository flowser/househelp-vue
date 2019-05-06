<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Operation;

class OperationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operation::create(['name'  => 'Day-worker',]);
        Operation::create(['name'  => 'Boarder',]);
    }
}
