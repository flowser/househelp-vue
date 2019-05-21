<?php

use Faker\Factory;
use App\Models\Bureau\Bureau;
use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Bureau\BureauAdmin;
use App\Models\Bureau\BureauEmployee;
use App\Models\Standard\Constituency;


class BureauAdminTableSeeder extends Seeder
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


            foreach (range(1,10) as $index){
                $adminusersID = User::where('id', '>=', 15)->where('id', '<=', 24)->orderBy('id', 'asc')->first()->id;
                $bureausID = Bureau::orderBy('id', 'asc')->first()->id;

                $BureauAdminUser = BureauAdmin::orderBy('id', 'asc')->pluck('user_id')->toArray();
                $BureauAdmin = BureauAdmin::orderBy('id', 'asc')->pluck('bureau_id')->toArray();

                $uniqueUserID = User::where('id', '>=', 15)
                                   ->where('id', '<=', 24)->whereNotIn('id',  $BureauAdminUser)->first()->id;
                $uniqueBureauID = Bureau::orderBy('id', 'asc')->whereNotIn('id', $BureauAdmin)->first()->id;
                if($BureauAdminUser){
                    BureauAdmin::create([
                        'user_id'        => $uniqueUserID,
                        'bureau_id'      => $uniqueBureauID,
                        'position_id'    =>'3',
                        'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                        'id_no'          => $faker->unique(true)->numberBetween($min =1111111111, $max = 2222222222),
                        'active'         => true,
                        'phone'          => $faker->unique(true)->e164PhoneNumber,
                        'landline'       => $faker->unique(true)->tollFreePhoneNumber,
                        'address'        => $faker->postcode,
                        'country_id'     => $country->id,
                        'county_id'      => $county->id,
                        'constituency_id'=> $constituency->id,
                        'ward_id'        => $ward->id,
                    ]);

                }else{
                    BureauAdmin::create([
                        'user_id'        => $adminusersID,
                        'bureau_id'      => $bureausID,
                        'position_id'    =>'3',
                        'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                        'id_no'          => $faker->unique(true)->numberBetween($min =1111111111, $max = 2222222222),
                        'active'         => true,
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

        foreach (range(1,10) as $index){
                $employeeusersID = User::where('id', '>=', 25)->where('id', '<=', 34)->orderBy('id', 'asc')->first()->id;
                $bureausID = Bureau::orderBy('id', 'asc')->first()->id;

                $BureauEmployeeUser =  BureauEmployee::orderBy('id', 'asc')->pluck('user_id')->toArray();
                $BureauEmployee =  BureauEmployee::orderBy('id', 'asc')->pluck('bureau_id')->toArray();

                $uniqueUserID = User::where('id', '>=', 25)
                                   ->where('id', '<=', 34)->whereNotIn('id', $BureauEmployeeUser)->first()->id;
                $uniqueBureauID = Bureau::orderBy('id', 'asc')->whereNotIn('id', $BureauEmployee)->first()->id;
                if( $BureauEmployeeUser){
                    BureauEmployee::create([
                        'user_id'        => $uniqueUserID,
                        'bureau_id'      =>  $uniqueBureauID,
                        'position_id'    =>'3',
                        'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                        'id_no'          => $faker->unique(true)->numberBetween($min =1111111111, $max = 2222222222),
                        'active'         => true,
                        'phone'          => $faker->unique(true)->e164PhoneNumber,
                        'landline'       => $faker->unique(true)->tollFreePhoneNumber,
                        'address'        => $faker->postcode,
                        'country_id'     => $country->id,
                        'county_id'      => $county->id,
                        'constituency_id'=> $constituency->id,
                        'ward_id'        => $ward->id,
                    ]);
                }else{
                    BureauEmployee::create([
                        'user_id'        => $employeeusersID,
                        'bureau_id'      =>  $bureausID,
                        'position_id'    =>'3',
                        'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                        'id_no'          => $faker->unique(true)->numberBetween($min =1111111111, $max = 2222222222),
                        'active'         => true,
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
