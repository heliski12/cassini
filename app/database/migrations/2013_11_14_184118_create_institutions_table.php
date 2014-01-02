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
			$table->string("logo_file_name")->nullable();
			$table->integer("logo_file_size")->nullable();
			$table->string("logo_content_type")->nullable();
			$table->timestamp("logo_updated_at")->nullable();
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
