<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Househelp\Standard\Idstatus;

class IDStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $frontIDPath = public_path()."/assets/bureau/img/househelps/IDs/front";
        $backIDPath = public_path()."/assets/bureau/img/househelps/IDs/back";
        $waitingCardPath = public_path()."/assets/bureau/img/househelps/waitingcards";

        for ($i = 0; $i < 480; $i++) {
            Idstatus::create([
                'status'            => 'yes',
                'reason'            => null,
                'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                'ref_number'        => null,
                'id_photo_front'    => $faker->unique()->image($frontIDPath, 400,300, 'people', false),
                'id_photo_back'     => $faker->unique()->image($backIDPath, 400,300, 'people', false),
                'waiting_card_photo'=> null,
                'bureau_househelp_id'=> $faker->numberBetween($min = 1, $max = 480),
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Idstatus::create([
                'status'            => 'no',
                'reason'            => 'lost but applied',
                'id_number'         => null,
                'ref_number'        => $faker->unique()->numberBetween($min = 3333333333, $max = 4444444444),
                'id_photo_front'    => null,
                'id_photo_back'     => null,
                'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                'bureau_househelp_id'=> $faker->numberBetween($min = 481, $max = 490),
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Idstatus::create([
                'status'            => 'no',
                'reason'            => 'applied',
                'id_number'         => null,
                'ref_number'        => $faker->unique()->numberBetween($min = 4444444444, $max = 5555555555),
                'id_photo_front'    => null,
                'id_photo_back'     => null,
                'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                'bureau_househelp_id'=> $faker->numberBetween($min = 491, $max = 500),
            ]);
        }
    }
}
