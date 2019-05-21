<?php

use Faker\Factory;
use App\Models\Bureau\Bureau;
use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Househelp\Househelp;
use App\Models\Standard\Constituency;
use App\Models\Househelp\HousehelpKin;

class HousehelpKinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $country = Country::first();//->all()->random(); //or whatever

        if($country){
            $county = County::where('country_id', $country->id)
                   ->inRandomOrder()->first();

            if($county){
                $constituency = Constituency::where('county_id', $county->id)
                             ->inRandomOrder()->first();

                if($constituency){
                     $ward = Ward::where('constituency_id', $constituency->id)
                                 ->inRandomOrder()->first();

                }
            }
        }


        $kinPassportPath = public_path()."/assets/bureau/img/househelps/househelpkins/passports";
        $kinfrontIDPath = public_path()."/assets/bureau/img/househelps/househelpkins/IDs/front";
        $kinbackIDPath = public_path()."/assets/bureau/img/househelps/househelpkins/IDs/back";
        // househelpkins id 537-1036

        foreach (range(1,100) as $index){
                $HousehelpkinusersID = User::where('id', '>=', 135)->where('id', '<=', 234)->orderBy('id', 'asc')->first()->id;
                $HousehelpID = Househelp::orderBy('id', 'asc')->first()->id;

                $HousehelpkinUser = HousehelpKin::orderBy('id', 'asc')->pluck('user_id')->toArray();
                $Househelp = HousehelpKin::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();

                $uniqueUserID = User::where('id', '>=', 135)
                                   ->where('id', '<=', 234)->whereNotIn('id',  $HousehelpkinUser)->first()->id;
                $uniqueHousehelpID = Househelp::orderBy('id', 'asc')->whereNotIn('id', $Househelp)->first()->id;
                if($HousehelpkinUser){
                    HousehelpKin::create([
                        'user_id'           => $uniqueUserID,
                        'bureau_househelp_id'=> $uniqueHousehelpID,
                        'relationship_id'   => $faker->numberBetween($min = 1, $max = 9),
                        'photo'             => $faker->unique(true)->image($kinPassportPath, 400,300, 'people', false),

                        'id_no'             => $faker->unique(true)->numberBetween($min = 11111111, $max = 22222222),
                        'id_photo_front'    => $faker->unique(true)->image($kinfrontIDPath, 400,300, 'nature', false),
                        'id_photo_back'     => $faker->unique(true)->image($kinbackIDPath, 400,300, 'technics', false),

                        'phone'             => $faker->e164PhoneNumber,
                        'address'           => $faker->postcode,
                        'active'            => true,

                        'country_id'       => $country->id,
                        'county_id'        => $county->id,
                        'constituency_id'  => $constituency->id,
                        'ward_id'          => $ward->id,
                    ]);
                }else{
                    HousehelpKin::create([
                        'user_id'           => $HousehelpkinusersID,
                        'bureau_househelp_id'=> $HousehelpID,
                        'relationship_id'   => $faker->numberBetween($min = 1, $max = 9),
                        'photo'             => $faker->unique(true)->image($kinPassportPath, 400,300, 'people', false),

                        'id_no'             => $faker->unique(true)->numberBetween($min = 11111111, $max = 22222222),
                        'id_photo_front'    => $faker->unique(true)->image($kinfrontIDPath, 400,300, 'nature', false),
                        'id_photo_back'     => $faker->unique(true)->image($kinbackIDPath, 400,300, 'technics', false),

                        'phone'             => $faker->e164PhoneNumber,
                        'address'           => $faker->postcode,
                        'active'            => true,

                        'country_id'       => $country->id,
                        'county_id'        => $county->id,
                        'constituency_id'  => $constituency->id,
                        'ward_id'          => $ward->id,
                    ]);
                }
        }
    }
}
