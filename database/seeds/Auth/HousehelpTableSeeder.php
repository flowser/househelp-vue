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

class HousehelpTableSeeder extends Seeder
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
        $PassportPath = public_path()."/assets/bureau/img/househelps/passports";
        // househelps id 35-134

        foreach (range(1,100) as $index){

                $HousehelpusersID = User::where('id', '>=', 35)->where('id', '<=', 134)->orderBy('id', 'asc')->first()->id;
                $bureausID = Bureau::orderBy('id', 'asc')->pluck('id')->toArray();

                $HousehelpUser = Househelp::orderBy('id', 'asc')->pluck('user_id')->toArray();
                // $Househelp = Househelp::orderBy('id', 'asc')->pluck('bureau_id')->toArray();

                $uniqueUserID = User::where('id', '>=', 35)
                                   ->where('id', '<=', 134)->whereNotIn('id',  $HousehelpUser)->first()->id;
                // $uniqueBureauID = Bureau::orderBy('id', 'asc')->whereNotIn('id', $Househelp)->first()->id;
                if($HousehelpUser){
                Househelp::create([
                    'user_id'           => $uniqueUserID,
                    'bureau_id'         => $faker->randomElement($bureausID),
                    'photo'             => $faker->unique(true)->image($PassportPath, 400,300, 'people', false),
                    'about_me'          => $faker-> text($maxNbChars = 200),
                    'phone'             => $faker->unique(true)->e164PhoneNumber,
                    'address'           => $faker->postcode,
                    'active'            => true,
                    'employmentstatus'  => false,
                    'hiredstatus'       => false,

                    'country_id'       => $country->id,
                    'county_id'        => $county->id,
                    'constituency_id'  => $constituency->id,
                    'ward_id'          => $ward->id,

                    //filters

                    'age'              => $faker->numberBetween($min = 18, $max = 50),
                    'gender_id'        => $faker->numberBetween($min =1, $max = 2),
                    'education_id'     => $faker->numberBetween($min =1, $max = 4),
                    'experience_id'    => $faker->numberBetween($min =1, $max = 7),
                    'maritalstatus_id' => $faker->numberBetween($min =1, $max = 3),
                    'tribe_id'         => $faker->numberBetween($min =1, $max = 16),
                    'skill_id'         => $faker->numberBetween($min =1, $max = 4),
                    'operation_id'     => $faker->numberBetween($min =1, $max = 2),
                    'duration_id'      => $faker->numberBetween($min =1, $max = 5),
                    'englishstatus_id' => $faker->numberBetween($min =1, $max = 3),
                    'religion_id'      => $faker->numberBetween($min =1, $max = 4),
                    'kid_id'           => $faker->numberBetween($min =1, $max = 2),
                ]);
            }else{
                Househelp::create([
                    'user_id'           => $HousehelpusersID,
                    'bureau_id'         => $faker->randomElement($bureausID),
                    'photo'             => $faker->unique(true)->image($PassportPath, 400,300, 'people', false),
                    'about_me'          => $faker-> text($maxNbChars = 200),
                    'phone'             => $faker->unique(true)->e164PhoneNumber,
                    'address'           => $faker->postcode,
                    'active'            => true,
                    'employmentstatus'  => false,
                    'hiredstatus'       => false,

                    'country_id'       => $country->id,
                    'county_id'        => $county->id,
                    'constituency_id'  => $constituency->id,
                    'ward_id'          => $ward->id,

                    //filters

                    'age'              => $faker->numberBetween($min = 18, $max = 50),
                    'gender_id'        => $faker->numberBetween($min =1, $max = 2),
                    'education_id'     => $faker->numberBetween($min =1, $max = 4),
                    'experience_id'    => $faker->numberBetween($min =1, $max = 7),
                    'maritalstatus_id' => $faker->numberBetween($min =1, $max = 3),
                    'tribe_id'         => $faker->numberBetween($min =1, $max = 16),
                    'skill_id'         => $faker->numberBetween($min =1, $max = 4),
                    'operation_id'     => $faker->numberBetween($min =1, $max = 2),
                    'duration_id'      => $faker->numberBetween($min =1, $max = 5),
                    'englishstatus_id' => $faker->numberBetween($min =1, $max = 3),
                    'religion_id'      => $faker->numberBetween($min =1, $max = 4),
                    'kid_id'           => $faker->numberBetween($min =1, $max = 2),
                ]);
            }
        }
    }
}
