<?php

class PublicationsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('publications')->delete();


      $publications = [ 
        [ 'id' => 101, 'name' => 'Scientific American' ],
        [ 'id' => 102, 'name' => 'Nature' ],
        [ 'id' => 103, 'name' => 'Science' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('publications')->insert($publications);
    }

}

