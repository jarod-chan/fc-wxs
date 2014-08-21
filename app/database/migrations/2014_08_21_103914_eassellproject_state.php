<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EassellprojectState extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::table('eas_t_she_sellproject',function ($table){
		 	$table->String('state')->default('off');//状态 on off  表示是否启用
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::table('eas_t_she_sellproject',function ($table){
		 	$table->dropColumn("state");
		 });
	}

}
