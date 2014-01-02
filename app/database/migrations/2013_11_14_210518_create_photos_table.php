<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table) {
			$table->increments('id');
      $table->integer('profile_id');
			$table->string('description');
			$table->string("photo_file_name")->nullable();
			$table->integer("photo_file_size")->nullable();
			$table->string("photo_content_type")->nullable();
			$table->timestamp("photo_updated_at")->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photos');
	}

}
