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
                            'status'            => 'Yes',
                            'reason'            => "Has ID Card",
                            'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                            'ref_number'        => null,
                            'id_photo_front'    => $faker->unique()->image($frontIDPath, 400,300, 'people', false),
                            'id_photo_back'     => $faker->unique()->image($backIDPath, 400,300, 'people', false),
                            'waiting_card_photo'=> null,
                            'bureau_househelp_id'=> $uniqueHousehelpID,
                        ]);
                }else{
                    Idstatus::create([
                        'status'            => 'Yes',
                        'reason'            => "Has ID Card",
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => null,
                        'id_photo_front'    => $faker->unique()->image($frontIDPath, 400,300, 'people', false),
                        'id_photo_back'     => $faker->unique()->image($backIDPath, 400,300, 'people', false),
                        'waiting_card_photo'=> null,
                        'bureau_househelp_id'=> $HousehelpID,
                    ]);
                }
        }

        foreach (range(1,20) as $index){
                $HousehelpID = Househelp::where('id', '>=', 61)->where('id', '<=', 80)->orderBy('id', 'asc')->first()->id;
                $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
                $uniqueHousehelpID = Househelp::where('id', '>=', 61)
                                ->where('id', '<=', 80)->whereNotIn('id',  $HousehelpIDS)->first()->id;
                if($HousehelpIDS){
                    Idstatus::create([
                        'status'            => 'Yes',
                        'reason'            => "Has ID Card but lost, however applied for replacement",
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => $faker->unique()->numberBetween($min = 44444444, $max = 55555555),
                        'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                        'bureau_househelp_id'=> $uniqueHousehelpID,
                    ]);
                }else{
                    Idstatus::create([
                        'status'            => 'Yes',
                        'reason'            => "Has ID Card but lost, however applied for replacement",
                        'id_number'         => $faker->unique()->numberBetween($min = 22222222, $max = 33333333),
                        'ref_number'        => $faker->unique()->numberBetween($min = 44444444, $max = 55555555),
                        'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                        'bureau_househelp_id'=> $HousehelpID,
                    ]);
                }

        }
        foreach (range(1,10) as $index){
            $HousehelpID = Househelp::where('id', '>=', 81)->where('id', '<=', 90)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 81)
                            ->where('id', '<=', 90)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($HousehelpIDS){
                Idstatus::create([
                    'status'            => 'No',
                    'reason'            => "Dont Have ID Card but applied for new Card",
                    'id_number'         => null,
                    'ref_number'        => $faker->unique()->numberBetween($min = 6000000, $max = 7000000),
                    'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                    'bureau_househelp_id'=> $uniqueHousehelpID,
                ]);
            }else{
                Idstatus::create([
                    'status'            => 'No',
                    'reason'            => "Dont Have ID Card but applied for new Card",
                    'id_number'         => null,
                    'ref_number'        => $faker->unique()->numberBetween($min = 6000000, $max = 7000000),
                    'waiting_card_photo'=> $faker->unique()->image($waitingCardPath, 400,300, 'people', false),
                    'bureau_househelp_id'=> $HousehelpID,
                ]);
            }
        }
        foreach (range(1,10) as $index){
            $HousehelpID = Househelp::where('id', '>=', 91)->where('id', '<=', 100)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Idstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 91)
                        ->where('id', '<=', 100)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($uniqueHousehelpID){
                        Idstatus::create([
                            'status'            => 'No',
                            'reason'            => "Dont Have ID Card and Has not applied for new Card",
                            'id_number'         => null,
                            'ref_number'        => null,
                            'waiting_card_photo'=> null,
                            'bureau_househelp_id'=> $uniqueHousehelpID,
                        ]);
                }else{
                        Idstatus::create([
                            'status'            => 'No',
                            'reason'            => "Dont Have ID Card and Has not applied for new Card",
                            'id_number'         => null,
                            'ref_number'        => null,
                            'waiting_card_photo'=> null,
                            'bureau_househelp_id'=> $HousehelpID,
                        ]);
                }
            }
    }
}
