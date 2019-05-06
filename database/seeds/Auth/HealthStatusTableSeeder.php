<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Healthstatus;

class HealthStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 480; $i++) {
            Healthstatus::create([
                'bureau_househelp_id'=>$faker->unique()->numberBetween($min = 1, $max = 480),
                'status'            =>'Healthy',
                'HIV_status'        =>'Negative',
                'other_chronics'    => null,
                'chronic_details'   => null,
                'allergy'           => null,
                'specify'           => null,
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Healthstatus::create([
                'bureau_househelp_id'=> $faker->unique()->numberBetween($min = 481, $max = 490),
                'status'            =>'HASMINOR',
                'HIV_status'        => 'Negative',
                'other_chronics'    => null,
                'chronic_details'   => null,
                'allergy'           => 'nuts',
                'specify'           => null,
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Healthstatus::create([
                'bureau_househelp_id'=> $faker->unique()->numberBetween($min = 491, $max = 500),
                'status'            => 'HASCHRONIC',
                'HIV_status'        => 'Negative',
                'other_chronics'    => 'none',
                'chronic_details'   => 'Asthmatic',
                'allergy'           =>  null,
                'specify'           =>  null,
            ]);
        }
    }
}
