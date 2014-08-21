<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpfileImageable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::table('sy_file',function ($table){
		 	if (Schema::hasColumn('sy_file', 'pkid'))
		 	{
		 		$table->dropColumn('pkid');
		 		$table->dropColumn('tabname');
		 	}
		 	$table->integer('fileable_id');
		 	$table->String('fileable_type');
		 });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::table('sy_file',function ($table){
		 	$table->dropColumn('fileable_id');
		 	$table->dropColumn('fileable_type');
		 });
	}

}
