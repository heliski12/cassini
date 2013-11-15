<?php

class SectorsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('sectors')->delete();


      $sectors = [ 
        [ 'id' => 1, 'name' => 'Food' ],
        [ 'id' => 2, 'name' => 'Agriculture' ],
        [ 'id' => 3, 'name' => 'Green Building and Design' ],
        [ 'id' => 4, 'name' => 'Transportation' ],
        [ 'id' => 5, 'name' => 'Materials' ],
        [ 'id' => 6, 'name' => 'Energy' ],
        [ 'id' => 7, 'name' => 'Biomimicry' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('sectors')->insert($sectors);
    }

}

