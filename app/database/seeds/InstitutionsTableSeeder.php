<?php

class InstitutionsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('institutions')->delete();


      $institutions = [ 
        [ 'id' => 1, 'name' => 'Stanford', 'city' => 'Palo Alto', 'state' => 'California', 'country' => 'USA' ],
        [ 'id' => 2, 'name' => 'Harvard', 'city' => 'Cambridge', 'state' => 'Massachusetts', 'country' => 'USA' ],
        [ 'id' => 3, 'name' => 'Princeton', 'city' => 'Princeton', 'state' => 'New Jersey', 'country' => 'USA' ],
        [ 'id' => 4, 'name' => 'Cornell', 'city' => 'Ithaca', 'state' => 'New York', 'country' => 'USA' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('institutions')->insert($institutions);
    }

}

