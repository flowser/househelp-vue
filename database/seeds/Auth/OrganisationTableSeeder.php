<?php

use Faker\Factory;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use Illuminate\Database\Seeder;
use App\Models\Standard\Country;
use App\Models\Standard\Constituency;
use App\Models\Organisation\Organisation;

class OrganisationTableSeeder extends Seeder
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


        $Path = public_path()."/assets/organisation/img/logo";

        Organisation::create([
            'name'                  => 'Teif Foundation',
            'logo'                  => $faker->image($Path, 400,300, 'animals', false),
             'organisation_email'   => $faker->companyEmail,
             'phone'                => $faker->e164PhoneNumber,
             'landline'             => $faker->tollFreePhoneNumber,
             'website'              => $faker->url,
             'address'              => $faker->postcode,
             'active'               => true,
             'country_id'           => $country->id,
             'county_id'            => $county->id,
             'constituency_id'      => $constituency->id,
             'ward_id'              => $ward->id,
            ]);
    }
}
