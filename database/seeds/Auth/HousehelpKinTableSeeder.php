<?php

use Faker\Factory;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
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
        for ($i = 0; $i < 500; $i++) {
            HousehelpKin::create([
                'user_id'           => $faker->numberBetween($min = 537, $max = 1036),
                'bureau_househelp_id'=> $faker->numberBetween($min = 1, $max = 500),
                'relationship_id'   => $faker->numberBetween($min = 1, $max = 9),
                'photo'             => $faker->unique()->image($kinPassportPath, 400,300, 'people', false),

                'id_no'             => $faker->unique()->numberBetween($min = 11111111, $max = 22222222),
                'id_photo_front'    => $faker->unique()->image($kinfrontIDPath, 400,300, 'nature', false),
                'id_photo_back'     => $faker->unique()->image($kinbackIDPath, 400,300, 'technics', false),

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
