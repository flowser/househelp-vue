<?php

use Faker\Factory;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Standard\Constituency;
use App\Models\Organisation\OrganisationDirector;


class OrganisationDirectorTableSeeder extends Seeder
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
        for ($i = 0; $i < 3; $i++) {
            OrganisationDirector::create([
                'user_id'        => $faker->unique()->numberBetween($min = 4, $max = 6),
                'organisation_id'=>          '1',
                'position_id'    =>          '1',
                'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                'id_no'          => $faker->unique()->numberBetween($min =444444444, $max = 555555555),
                'active'         => true,
                'phone'          => $faker->unique()->e164PhoneNumber,
                'landline'       => $faker->unique()->tollFreePhoneNumber,
                'address'        => $faker->postcode,
                'country_id'     => $country->id,
                'county_id'      => $county->id,
                'constituency_id'=> $constituency->id,
                'ward_id'        => $ward->id,
            ]);
        }
    }
}
