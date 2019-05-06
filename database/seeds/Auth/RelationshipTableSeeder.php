<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Relationship;

class RelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Relationship::create(['name'  => 'Father',]);
        Relationship::create(['name'  => 'Mother',]);
        Relationship::create(['name'  => 'Sister',]);
        Relationship::create(['name'  => 'Brother',]);
        Relationship::create(['name'  => 'Cousin',]);
        Relationship::create(['name'  => 'Grandfather',]);
        Relationship::create(['name'  => 'Grandmother',]);
        Relationship::create(['name'  => 'Uncle',]);
        Relationship::create(['name'  => 'Aunt',]);
    }
}
