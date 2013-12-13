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
			$table->enum('innovator_type', array('ENTREPRENEUR','RESEARCHER'));
      $table->integer('institution_id')->nullable();
			$table->string('institution_department');
			$table->string('organization');
			$table->enum('organization_type', array('FOR_PROFIT','NON_PROFIT'));
			$table->string('tech_title');
			$table->text('tech_description');
			$table->enum('product_stage',array('EXPERIMENTAL','PROTOTYPE','MARKET_PILOT','MARKET'));
			$table->boolean('fs_funded');
			$table->boolean('fs_seeking');
			$table->boolean('fs_not_funded');
      $table->text('fs_extra_info');
			$table->boolean('ip_trademarks');
			$table->boolean('ip_trademarks_pending');
			$table->boolean('ip_patents');
			$table->boolean('ip_patents_pending');
			$table->string('website_url');
			$table->string('website_title');
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
