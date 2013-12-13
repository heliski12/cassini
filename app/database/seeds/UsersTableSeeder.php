<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('users')->delete();


      $users = [ 
        [ 'id' => 1, 'email' => 'jstavis@gmail.com', 'password' => Hash::make('blahblah'), 'role' => 'ADMIN' ],
        [ 'id' => 2, 'email' => 'amanda@motionry.com', 'password' => Hash::make('abcd1234'), 'role' => 'ADMIN' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}

