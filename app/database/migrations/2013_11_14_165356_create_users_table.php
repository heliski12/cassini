<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('password');
      $table->datetime('last_login')->nullable();
			$table->boolean('innovator');
			$table->boolean('seeker');
			$table->boolean('unsure');
      $table->string('title')->nullable();
      $table->string('organization')->nullable();
			$table->enum('role',array('PENDING','USER','PRESS','ADMIN'));
      $table->string('phone')->nullable();
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
		Schema::drop('users');
	}

}
