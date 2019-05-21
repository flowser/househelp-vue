<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Househelp\Househelp;
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

        foreach (range(1,60) as $index){
                $HousehelpID = Househelp::where('id', '>=', 1)->where('id', '<=', 60)->orderBy('id', 'asc')->first()->id;

                $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();

                $uniqueHousehelpID = Househelp::where('id', '>=', 1)
                                   ->where('id', '<=', 60)->whereNotIn('id',  $HousehelpIDS)->first()->id;
                if($HousehelpIDS){
                        Idstatus::create([
                            'status'            => 'yes',
                            'reason'            => null,
                            'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                            'ref_number'        => null,
                            'id_photo_front'    => $faker->unique()->image($frontIDPath, 400,300, 'people', false),
                            'id_photo_back'     => $faker->unique()->image($backIDPath, 400,300, 'people', false),
                            'waiting_card_photo'=> null,
                            'bureau_househelp_id'=> $uniqueHousehelpID,
                        ]);
                }else{
                    Idstatus::create([
                        'status'            => 'yes',
                        'reason'            => null,
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => null,
                        'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                        'bureau_househelp_id'=> $HousehelpID,
                    ]);
                }
        }

        foreach (range(1,25) as $index){
                $HousehelpID = Househelp::where('id', '>=', 61)->where('id', '<=', 85)->orderBy('id', 'asc')->first()->id;
                $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
                $uniqueHousehelpID = Househelp::where('id', '>=', 61)
                                ->where('id', '<=', 85)->whereNotIn('id',  $HousehelpIDS)->first()->id;
                if($HousehelpIDS){
                    Idstatus::create([
                        'status'            => 'no',
                        'reason'            => 'lost but applied',
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => null,
                        'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                        'bureau_househelp_id'=> $uniqueHousehelpID,
                    ]);
                }else{
                    Idstatus::create([
                        'status'            => 'no',
                        'reason'            => 'lost but applied',
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => null,
                        'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                        'bureau_househelp_id'=> $HousehelpID,
                    ]);
                }

        }
        foreach (range(1,15) as $index){
            $HousehelpID = Househelp::where('id', '>=', 86)->where('id', '<=', 100)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 86)
                            ->where('id', '<=', 100)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($HousehelpIDS){
                            Idstatus::create([
                                'status'            => 'no',
                                'reason'            => 'applied',
                                'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                                'ref_number'        => null,
                                'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                                'bureau_househelp_id'=> $uniqueHousehelpID,
                            ]);
                    }else{
                        Idstatus::create([
                            'status'            => 'no',
                            'reason'            => 'applied',
                            'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                            'ref_number'        => null,
                            'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                            'bureau_househelp_id'=> $HousehelpID,
                        ]);
                    }
        }
    }
}
