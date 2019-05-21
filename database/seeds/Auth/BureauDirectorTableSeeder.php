<?php

use Faker\Factory;
use App\Models\Bureau\Bureau;
use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Bureau\BureauDirector;
use App\Models\Standard\Constituency;

class BureauDirectorTableSeeder extends Seeder
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

        // Superadmin admin n accounts 1,2-3
        // for ($i = 0; $i < 10; $i++) {






             foreach (range(1,10) as $index){
                $usersID = User::where('id', '>=', 5)
                ->where('id', '<=', 14)
                ->orderBy('id', 'asc')->first()->id;

                $BureauDirectorUser = BureauDirector::orderBy('id', 'asc')->pluck('user_id')->toArray();
                $BureauDirector = BureauDirector::orderBy('id', 'asc')->pluck('bureau_id')->toArray();

                $bureausID = Bureau::orderBy('id', 'asc')->first()->id;
                $uniqueUserID = User::where('id', '>=', 5)
                                   ->where('id', '<=', 14)->whereNotIn('id', $BureauDirectorUser)->first()->id;
                $uniqueBureauID = Bureau::orderBy('id', 'asc')->whereNotIn('id', $BureauDirector)->first()->id;
                 if($BureauDirectorUser){
                     BureauDirector::create([
                         // 'user_id'        => $faker->unique(true)->numberBetween($min = 5, $max = 14),
                         'user_id'        => $uniqueUserID,
                         'bureau_id'      => $uniqueBureauID,
                         'position_id'    =>'1',
                         'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                         'active'         => true,
                         'id_no'          => $faker->unique(true)->numberBetween($min =666666666, $max = 777777777),
                         'phone'          => $faker->unique(true)->e164PhoneNumber,
                         'landline'       => $faker->unique(true)->tollFreePhoneNumber,
                         'address'        => $faker->postcode,
                         'country_id'     => $country->id,
                         'county_id'      => $county->id,
                         'constituency_id'=> $constituency->id,
                         'ward_id'        => $ward->id,
                     ]);
                 }else{
                    BureauDirector::create([
                        // 'user_id'        => $faker->unique(true)->numberBetween($min = 5, $max = 14),
                        'user_id'        => $usersID,
                        'bureau_id'      =>  $bureausID,
                        'position_id'    =>'1',
                        'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                        'active'         => true,
                        'id_no'          => $faker->unique(true)->numberBetween($min =666666666, $max = 777777777),
                        'phone'          => $faker->unique(true)->e164PhoneNumber,
                        'landline'       => $faker->unique(true)->tollFreePhoneNumber,
                        'address'        => $faker->postcode,
                        'country_id'     => $country->id,
                        'county_id'      => $county->id,
                        'constituency_id'=> $constituency->id,
                        'ward_id'        => $ward->id,
                    ]);
                 }
             }
    }
}
