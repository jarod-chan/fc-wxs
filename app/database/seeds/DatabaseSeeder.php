<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Eloquent::unguard();

		 $this->call('UserSeed');
		 $this->command->info('user table seeded!');
	}

}

class UserSeed extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('name'=>'foo','password'=>'foopass','email' => 'foo@bar.com'));
    }

}