<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('creator_id');
			$table->enum('status',array('STARTED','COMPLETE_PENDING','PUBLISHED','REVOKED'));
			$table->enum('provider_type', array('TECHNOLOGY_ENTREPRENEUR','ACADEMIC_RESEARCHER','GOVERNMENT_RESEARCHER'));
      $table->integer('institution_id')->nullable();
			$table->string('institution_department');
			$table->string('organization');
			$table->boolean('organization_for_profit');
			$table->string('tech_title');
			$table->text('tech_description');
			$table->enum('product_stage',array('EXPERIMENTAL','PROTOTYPE','MARKET_PILOT','MARKET'));
			$table->enum('funding_status',array('FUNDED','SEEKING','NOT_FUNDED'));
			$table->boolean('ip_trademarks');
			$table->boolean('ip_trademarks_pending');
			$table->boolean('ip_patents');
			$table->boolean('ip_patents_pending');
			$table->string('url');
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
		Schema::drop('profiles');
	}

}
