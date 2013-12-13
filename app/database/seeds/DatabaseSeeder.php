<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('SectorsTableSeeder');
    $this->command->info('Sectors table has been seeded');
		$this->call('RegionsTableSeeder');
    $this->command->info('Regionstable has been seeded');
		$this->call('UsersTableSeeder');
    $this->command->info('users table has been seeded');
    
	}

}
