<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Househelp\Househelp;
use App\Models\Househelp\Standard\Healthstatus;

class HealthStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,60) as $index){
            $HousehelpID = Househelp::where('id', '>=', 1)->where('id', '<=', 60)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Healthstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 1)
                               ->where('id', '<=', 60)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($HousehelpIDS){
                Healthstatus::create([
                    'bureau_househelp_id'=>$uniqueHousehelpID,
                    'status'            =>'Healthy',
                    'HIV_status'        =>'Negative',
                    'other_chronics'    => null,
                    'chronic_details'   => null,
                    'allergy'           => null,
                    'specify'           => null,
                ]);
            }else{
                Healthstatus::create([
                    'bureau_househelp_id'=>$HousehelpID,
                    'status'            =>'Healthy',
                    'HIV_status'        =>'Negative',
                    'other_chronics'    => null,
                    'chronic_details'   => null,
                    'allergy'           => null,
                    'specify'           => null,
                ]);
            }
        }
        foreach (range(1,25) as $index){
            $HousehelpID = Househelp::where('id', '>=', 61)->where('id', '<=', 85)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Healthstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 61)
                            ->where('id', '<=', 85)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($HousehelpIDS){
                Healthstatus::create([
                    'bureau_househelp_id'=> $uniqueHousehelpID,
                    'status'            =>'HASMINOR',
                    'HIV_status'        => 'Negative',
                    'other_chronics'    => null,
                    'chronic_details'   => null,
                    'allergy'           => "Has Minor Health Issues",
                    'specify'           => "nuts",
                ]);
            }else{
                Healthstatus::create([
                    'bureau_househelp_id'=> $HousehelpID,
                    'status'            =>'HASMINOR',
                    'HIV_status'        => 'Negative',
                    'other_chronics'    => null,
                    'chronic_details'   => null,
                    'allergy'           => "Has Minor Health Issues",
                    'specify'           => "nuts",
                ]);
            }
        }
        foreach (range(1,15) as $index){
            $HousehelpID = Househelp::where('id', '>=', 86)->where('id', '<=', 100)->orderBy('id', 'asc')->first()->id;
            $HousehelpIDS = Healthstatus::orderBy('id', 'asc')->pluck('bureau_househelp_id')->toArray();
            $uniqueHousehelpID = Househelp::where('id', '>=', 86)
                            ->where('id', '<=', 100)->whereNotIn('id',  $HousehelpIDS)->first()->id;
            if($HousehelpIDS){
                Healthstatus::create([
                    'bureau_househelp_id'=> $uniqueHousehelpID,
                    'status'            => 'HASCHRONIC',
                    'HIV_status'        => 'Negative',
                    'other_chronics'    => "Has Other Chronic Issues",
                    'chronic_details'   => 'Asthmatic',
                    'allergy'           =>  null,
                    'specify'           =>  null,
                ]);
            }else{
                Healthstatus::create([
                    'bureau_househelp_id'=> $HousehelpID,
                    'status'            => 'HASCHRONIC',
                    'HIV_status'        => 'Negative',
                    'other_chronics'    => "Has Other Chronic Issues",
                    'chronic_details'   => 'Asthmatic',
                    'allergy'           =>  null,
                    'specify'           =>  null,
                ]);
            }
        }
    }
}
