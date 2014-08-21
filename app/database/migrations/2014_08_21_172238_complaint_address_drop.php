<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComplaintAddressDrop extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::table('wx_complaint',function ($table){
		 	if (Schema::hasColumn('wx_complaint', 'address'))
		 	{
		 		$table->dropColumn('address');
		 	}
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
