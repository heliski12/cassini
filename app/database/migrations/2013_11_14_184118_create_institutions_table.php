<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table) {
			$table->increments('id');
			$table->enum('type',array('ACADEMIC','GOVERNMENT'));  
			$table->enum('status',array('PUBLISHED','NOT_PUBLISHED'));
			$table->integer('creator_id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('city');
			$table->string('state');
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
		Schema::drop('institutions');
	}

}
