<?php

use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Skill;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create(['name'  => 'Comfortable with Infant 0-2 years',]);
        Skill::create(['name'  => 'Comfortable with Toddler 3-6 years',]);
        Skill::create(['name'  => 'Comfortable with Child 7-12 years',]);
        Skill::create(['name'  => 'Comfortable with Teenagers above 12 years',]);
    }
}
