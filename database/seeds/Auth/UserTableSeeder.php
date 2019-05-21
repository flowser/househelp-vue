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
            $user1->assignRole('Superadmin');
            $user1->givePermissionTo('View Backend');
        }

        $faker = Faker\Factory::create();

        // admin n accounts 2-3

            $user2 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Organisation Director',
                'confirmed'         => true,
            ]);
            if($user2){
                $user2->assignRole('Director');
                $user2 ->givePermissionTo('View Backend', 'View All');
            }

            $user3 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Organisation Admin',
                'confirmed'         => true,
            ]);
            if($user3){
                $user3->assignRole('Admin');
                $user3 ->givePermissionTo('View Backend', 'View All');
            }

            $user4 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Organisation Employee',
                'confirmed'         => true,
            ]);
            if($user4){
                $user4->assignRole('Employee');
                $user4 ->givePermissionTo('View Backend', 'View All');
            }


        // burea directors id 5-14 (10 diectors)
        for ($i = 0; $i < 10; $i++) {
            $user5= User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Bureau Director',
                'confirmed'         => true,
            ]);
            if($user5){
                $user5->assignRole('Bureau Director');
                $user5 ->givePermissionTo('View Backend', 'View All');
            }
          }
        // bureau admin id 15-24 10
        for ($i = 0; $i < 10; $i++) {
            $user6 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Bureau Admin',
                'confirmed'         => true,
            ]);
            if($user6){
                $user6->assignRole('Bureau Admin');
                $user6 ->givePermissionTo('View Backend', 'View All');
            }
          }
        // id 25-34 10 employee
        for ($i = 0; $i < 10; $i++) {
            $user7 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Bureau Employee',
                'confirmed'         => true,
            ]);
            if($user7){
                $user7->assignRole('Bureau Employee');
            }
          }
        // househelps id 35-134 100 employee
        for ($i = 0; $i < 100; $i++) {
            $user8 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'Househelp',
                'confirmed'         => true,
            ]);
            if($user8){
                $user8->assignRole('Househelp');
            }
          }
        // househelpskin id 135-234
        for ($i = 0; $i < 100; $i++) {
            $user9 = User::create([
                'first_name'        => $faker ->firstNameMale,
                'last_name'         => $faker ->lastName,
                'email'             => $faker ->unique()->safeEmail,
                'password'          => Hash::make('flx4life'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'user_type'        => 'HousehelpKins',
                'confirmed'         => true,
            ]);
            if($user9){
                $user9->assignRole('Househelp Kin');
            }
          }
        // // client id 225-234
        // for ($i = 0; $i < 5; $i++) {
        //     $user10 = User::create([
        //         'first_name'        => $faker ->firstNameMale,
        //         'last_name'         => $faker ->lastName,
        //         'email'             => $faker ->unique()->safeEmail,
        //         'password'          => Hash::make('flx4life'),
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'user_type'        => 'Client',
        //         'confirmed'         => true,
        //     ]);
        //     if($user10){
        //         $user10->assignRole('Client');
        //     }
        //   }

        $this->enableForeignKeys();
    }
}
