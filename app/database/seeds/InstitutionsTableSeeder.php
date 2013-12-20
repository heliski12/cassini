<?php

class InstitutionsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('institutions')->delete();


      $institutions = [ 
        [ 'id' => 1, 'name' => 'Stanford' ],
        [ 'id' => 2, 'name' => 'Harvard' ],
        [ 'id' => 3, 'name' => 'Princeton' ],
        [ 'id' => 4, 'name' => 'Cornell' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('institutions')->insert($institutions);
    }

}

