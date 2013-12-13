<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeypersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keypersons', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('profile_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('title');
			$table->string('email');
			$table->string('phone');
			$table->string('twitter_handle');
			$table->string('linkedin_url');
			$table->string('address');
			$table->string('address_line2');
			$table->string('address_line3');
			$table->string('city');
			$table->string('state');
			$table->string('zip_code');
			$table->string('country');
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
		Schema::drop('keypersons');
	}

}
