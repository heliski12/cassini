<?php

class RegionsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('regions')->delete();


      $regions = [ 
        [ 'id' => 1, 'name' => 'North America' ],
        [ 'id' => 2, 'name' => 'Europe' ],
        [ 'id' => 3, 'name' => 'India' ],
        [ 'id' => 4, 'name' => 'Africa' ],
        [ 'id' => 5, 'name' => 'Australia' ],
        [ 'id' => 6, 'name' => 'Latin America' ],
        [ 'id' => 7, 'name' => 'Middle East' ],
        [ 'id' => 8, 'name' => 'China' ],
        [ 'id' => 9, 'name' => 'Asia' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('regions')->insert($regions);
    }

}

