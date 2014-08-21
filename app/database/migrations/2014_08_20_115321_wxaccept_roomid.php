<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WxacceptRoomid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::table('sy_accept',function ($table){
		 	if (Schema::hasColumn('sy_accept', 'community'))
		 	{
		 		$table->dropColumn('community');
			 	$table->dropColumn('area');
			 	$table->dropColumn('building');
			 	$table->dropColumn('room');
		 	}

		 	$table->String('room_id')->nullable();
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_accept',function ($table){
			$table->dropColumn('room_id');
		});
	}

}
