<?php

use Faker\Factory;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Standard\Constituency;
use App\Models\Organisation\OrganisationAdmin;

class OrganisationAdminTableSeeder extends Seeder
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

        OrganisationAdmin::create([
            'user_id'        => '1',
            'organisation_id'=> '1',
            'position_id'    => '5',//super admin
            'gender_id'      => '1',
            'active'         => '1',
            'country_id'     => '1',
            'county_id'      => '47',
            'constituency_id'=> '16',
            'ward_id'        => '1',
        ]);

        // Superadmin admin n accounts 1,2-3
        for ($i = 0; $i < 2; $i++) {
            OrganisationAdmin::create([
                'user_id'        => $faker->unique()->numberBetween($min = 2, $max = 3),
                'organisation_id'=>          '1',
                'position_id'    =>          '3',
                'gender_id'      => $faker-> numberBetween($min =1, $max = 2),
                'active'         => true,
                'country_id'     => $country->id,
                'county_id'      => $county->id,
                'constituency_id'=> $constituency->id,
                'ward_id'        => $ward->id,
            ]);
        }

    }
}
