<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilePublicationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_publication', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('profile_id');
			$table->integer('publication_id');
			$table->string('article_title');
			$table->string('article_url');
			$table->string('name');
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
		Schema::drop('profile_publication');
	}

}
