<?php


use Faker\Factory;
use App\Models\Standard\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Organisation\Organisation;
use App\Models\Organisation\OrganisationAdmin;

class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        $user1 =User::create([
                'first_name'        => 'Felix',
                'last_name'         => 'Nyachio',
                'email'             => 'felixnyachio@teifinnovate.foundation',
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Organisation Superadmin',
                'confirmed'         => true,
        ]);//2
        if($user1){
            $user1->assignRole('Superadmin','Affiliate');
            $user1->givePermissionTo('View Backend');
        }

        $faker = Faker\Factory::create();

        // admin n accounts 2-3
        for ($i = 0; $i < 2; $i++) {
            $user2 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Organisation Admin',
                'confirmed'         => true,
            ]);
            if($user2){
                $user2->assignRole('Admin');
                $user2 ->givePermissionTo('View Backend', 'View All');
            }
          }

        // directors id 3-6
        for ($i = 0; $i < 3; $i++) {
            $user3 = User::create([
                    'first_name'        => $faker ->firstNameMale,
                    'last_name'         => $faker ->lastName,
                    'email'             => $faker ->unique()->safeEmail,
                    'password'          => Hash::make('flx4life'),
                    'confirmation_code' => md5(uniqid(mt_rand(), true)),
                    'user_type'        => 'Organisation Director',
                    'confirmed'         => true,
                ]);
                if($user3){
                    $user3->assignRole('Director');
                    $user3 ->givePermissionTo('View Backend', 'View All');
                }
          }
        // bureau directors id 7-26
        for ($i = 0; $i < 20; $i++) {
            $user4= User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Bureau Director',
                'confirmed'         => true,
            ]);
            if($user4){
                $user4->assignRole('Bureau Director');
                $user4 ->givePermissionTo('View Backend', 'View All');
            }
          }
        // bureau admin id 27-36
        for ($i = 0; $i < 10; $i++) {
            $user5 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Bureau Admin',
                'confirmed'         => true,
            ]);
            if($user5){
                $user5->assignRole('Bureau Admin');
                $user5 ->givePermissionTo('View Backend', 'View All');
            }
          }
        // househelps id 37-536
        for ($i = 0; $i < 500; $i++) {
            $user6 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Househelp',
                'confirmed'         => true,
            ]);
            if($user6){
                $user6->assignRole('Househelp');
            }
          }
        // househelpskin id 537-1036
        for ($i = 0; $i < 500; $i++) {
            $user7 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'HousehelpKins',
                'confirmed'         => true,
            ]);
            if($user7){
                $user7->assignRole('Househelp Kin');
            }
          }
        // // clients id 1037 - 1536
        // for ($i = 0; $i < 500; $i++) {
        //     $user8 = User::create([
        //         'first_name'        => $faker ->firstNameMale,
        //         'last_name'         => $faker ->lastName,
        //         'email'             => $faker ->unique()->safeEmail,
        //         'password'          => Hash::make('flx4life'),
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'user_type'        => 'Client',
        //         'confirmed'         => true,
        //     ]);
        //     if($user8){

        //     }
        //   }
        $this->enableForeignKeys();
    }
}
