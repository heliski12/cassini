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
      $table->enum('status',array('STARTED','COMPLETE_PENDING','PUBLISHED','REVOKED'))->nullable();
      $table->enum('innovator_type', array('ENTREPRENEUR','RESEARCHER'))->nullable();
      $table->integer('institution_id')->nullable();
      $table->string('institution_department')->nullable();
      $table->string('organization')->nullable();
      $table->enum('organization_type', array('FOR_PROFIT','NON_PROFIT'))->nullable();
      $table->string('tech_title')->nullable();
      $table->text('tech_description')->nullable();
      $table->enum('product_stage',array('EXPERIMENTAL','PROTOTYPE','MARKET_PILOT','MARKET'))->nullable();
			$table->boolean('fs_funded');
			$table->boolean('fs_seeking');
			$table->boolean('fs_not_funded');
      $table->text('fs_extra_info')->nullable();
			$table->boolean('ip_trademarks');
			$table->boolean('ip_trademarks_pending');
			$table->boolean('ip_patents');
			$table->boolean('ip_patents_pending');
      $table->string('website_url')->nullable();
      $table->string('website_title')->nullable();
      $table->boolean('restrict_seekers');
      $table->boolean('restrict_researchers');
      $table->boolean('restrict_entrepreneurs');
			$table->string("organization_logo_file_name")->nullable();
			$table->integer("organization_logo_file_size")->nullable();
			$table->string("organization_logo_content_type")->nullable();
			$table->timestamp("organization_logo_updated_at")->nullable();
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
