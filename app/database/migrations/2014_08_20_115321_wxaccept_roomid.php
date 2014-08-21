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
		 DB::statement('alter table sy_accept change community  community varchar(255);');
		 DB::statement('alter table sy_accept change area area varchar(255);');
		 DB::statement('alter table sy_accept change building building varchar(255);');
		 DB::statement('alter table sy_accept change room room varchar(255);');
		 Schema::table('sy_accept',function ($table){
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
