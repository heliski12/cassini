<?php

class PublicationsTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
      DB::table('publications')->delete();


      $publications = [ 
        [ 'id' => 1, 'name' => 'Scientific American' ],
        [ 'id' => 2, 'name' => 'Nature' ],
        [ 'id' => 3, 'name' => 'Science' ],
      ];

        // Uncomment the below to run the seeder
        DB::table('publications')->insert($publications);
    }

}

