<?php



use App\Models\Standard\User;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
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

       User::find(1)->assignRole('Superadmin','Affiliate');

       User::find(1)->givePermissionTo('View Backend');


        $this->enableForeignKeys();
    }
}
