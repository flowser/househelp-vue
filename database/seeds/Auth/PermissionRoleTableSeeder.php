<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
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

            Permission::create(['name' => 'View Backend']);
            Permission::create(['name' => 'View Frontend']);
            Permission::create(['name' => 'View All']);
            Permission::create(['name' => 'Add']);
		    Permission::create(['name' => 'Edit']);
		    Permission::create(['name' => 'Delete']);
		    Permission::create(['name' => 'Disable']);


                      // Create Roles
                    //   organisation
        $superadmin    = Role::create(['name' => 'Superadmin']);
        $orgdirector   = Role::create(['name' => 'Director']);
        $orgemployee   = Role::create(['name' => 'Employee']);
        $orgadmin      = Role::create(['name' => 'Admin']);
        $orgaccountant = Role::create(['name' => 'Accountant']);
        $affiliate     = Role::create(['name' => 'Affiliate']);
        $client        = Role::create(['name' => 'Client']);
        // bureau
        $bureaudirector   = Role::create(['name' => 'Bureau Director']);
        $bureauemployee   = Role::create(['name' => 'Bureau Employee']);
        $bureauadmin      = Role::create(['name' => 'Bureau Admin']);
        $bureauaccountant = Role::create(['name' => 'Bureau Accountant']);

        $househelp = Role::create(['name' => 'Househelp']);
        $househelpkin = Role::create(['name' => 'Househelp Kin']);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $superadmin->givePermissionTo(
                   'View Backend',
                   'View All',
                    'Edit',
                   'Add', 'Delete', 'Disable'
               );
               //Director
        $orgdirector->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Add', 'Delete', 'Disable'
               );
        $orgadmin->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Add', 'Delete', 'Disable'
                  );
        $orgemployee->givePermissionTo(
                    'View Backend',
                     'Edit',
                     'Delete'
                  );
        $orgaccountant->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Delete', 'Disable'
                  );

        $affiliate->givePermissionTo(
                    'View Frontend',
                     'Edit'
                 );
        $client->givePermissionTo(
                    'View Frontend',
                     'Edit'
                 );
        //  Bureau
               //Director
        $bureaudirector->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Add', 'Delete', 'Disable'
               );
        $bureauadmin->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Add', 'Delete', 'Disable'
                  );
        $bureauemployee->givePermissionTo(
                    'View Backend',
                     'Edit',
                     'Delete'
                  );
        $bureauaccountant->givePermissionTo(
                    'View Backend',
                    'View All',
                     'Edit',
                    'Delete', 'Disable'
                  );
        $househelp->givePermissionTo('View Backend','View Frontend', 'Edit');
        $househelpkin->givePermissionTo('View Frontend', 'Edit');

        $this->enableForeignKeys();
    }
}
