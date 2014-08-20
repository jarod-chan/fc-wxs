<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WxcomplaintRoomid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wx_complaint',function ($table){
			$table->String('room_id')->nullable();//默认地址,客户投诉时默认用
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wx_complaint',function ($table){
			$table->dropColumn('room_id');
		});
	}

}
