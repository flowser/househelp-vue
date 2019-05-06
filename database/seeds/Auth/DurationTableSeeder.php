<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Duration;

class DurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Duration::create(['name'  => 'Overnight or Night Househelp',]);
        Duration::create(['name'  => 'Holiday Househelp',]);
        Duration::create(['name'  => 'Weekend Househelp',]);
        Duration::create(['name'  => 'Part-time Househelp',]);
        Duration::create(['name'  => 'Full time Househelp',]);

    }
}
