<?php

use Illuminate\Database\Seeder;

use App\Models\Users\User;
use App\Models\Users\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        factory(User::class, env('CLTVO_BASE_SEED' , 1)*5 )->create()->each(function($user) use ($roles){

		// role association
			if ( mt_rand(0, 9) <= 2 ) {
				$filter_roles = getRandomElements($roles) ;
		        $user->roles()->sync($filter_roles);
            }

        });
    }
}
