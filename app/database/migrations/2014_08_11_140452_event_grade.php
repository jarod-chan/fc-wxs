<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventGrade extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//投诉处理满意度
		Schema::table('wx_event',function ($table){
			$table->integer('grade_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wx_event',function ($table){
			$table->dropColumn('grade_id');
		});
	}

}
