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
use App\Models\Client\OrganisationClient;
use App\Models\Organisation\Organisation;

class ClientTableSeeder extends Seeder
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

        $ClientPassportPath = public_path()."/assets/organisation/img/clients/passports";
        $ClientfrontIDPath = public_path()."/assets/organisation/img/clients/IDs/front";
        $ClientbackIDPath = public_path()."/assets/organisation/img/clients/IDs/back";
        $background_imagePath = public_path()."/assets/organisation/img/clients/background";
        // clients id 537-1036

        foreach (range(1,5) as $index){
                $ClientusersID = User::where('id', '>=', 235)->where('id', '<=', 239)->orderBy('id', 'asc')->first()->id;
                $organisationID = Organisation::orderBy('id', 'asc')->first()->id;

                $ClientUser = OrganisationClient::orderBy('id', 'asc')->pluck('user_id')->toArray();

                $uniqueUserID = User::where('id', '>=', 235)
                                   ->where('id', '<=', 239)->whereNotIn('id',  $ClientUser)->first()->id;
                if($ClientUser){
                    OrganisationClient::create([
                        'user_id'           => $uniqueUserID,
                        'organisation_id'   => $organisationID,
                        'gender_id'         => $faker->unique(true)->numberBetween($min = 1, $max = 2),
                        'education_id'      => $faker->unique(true)->numberBetween($min = 1, $max = 4),
                        'organisation_affiliate_id' =>null,

                        'photo'             => $faker->unique(true)->image($ClientPassportPath, 400,300, 'people', false),
                        'background_image'  => $faker->unique(true)->image($background_imagePath, 400,300, 'people', false),

                        'id_no'             => $faker->unique(true)->numberBetween($min = 11111111, $max = 22222222),
                        'id_photo_front'    => $faker->unique(true)->image($ClientfrontIDPath, 400,300, 'nature', false),
                        'id_photo_back'     => $faker->unique(true)->image($ClientbackIDPath, 400,300, 'technics', false),

                        'phone'             => $faker->e164PhoneNumber,
                        'address'           => $faker->postcode,
                        'active'            => true,

                        'country_id'       => $country->id,
                        'county_id'        => $county->id,
                        'constituency_id'  => $constituency->id,
                        'ward_id'          => $ward->id,

                    ]);
                }else{
                    OrganisationClient::create([
                        'user_id'           => $ClientusersID,
                        'organisation_id'   => $organisationID,
                        'gender_id'         => $faker->unique(true)->numberBetween($min = 1, $max = 2),
                        'education_id'      => $faker->unique(true)->numberBetween($min = 1, $max = 4),
                        'organisation_affiliate_id' =>null,

                        'photo'             => $faker->unique(true)->image($ClientPassportPath, 400,300, 'people', false),
                        'background_image'  => $faker->unique(true)->image($background_imagePath, 400,300, 'people', false),

                        'id_no'             => $faker->unique(true)->numberBetween($min = 11111111, $max = 22222222),
                        'id_photo_front'    => $faker->unique(true)->image($ClientfrontIDPath, 400,300, 'nature', false),
                        'id_photo_back'     => $faker->unique(true)->image($ClientbackIDPath, 400,300, 'technics', false),

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


