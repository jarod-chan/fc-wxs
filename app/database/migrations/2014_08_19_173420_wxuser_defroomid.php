<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WxuserDefroomid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('wx_user',function ($table){
			$table->String('defroom_id')->nullable();//默认地址,客户投诉时默认用
		});
		Schema::table('wx_user', function($table)
		{
			if (Schema::hasColumn('wx_user', 'address_def'))
			{
				$table->dropColumn('address_def');
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
		Schema::table('wx_user',function ($table){
			$table->dropColumn('defroom_id');
		});
	}

}
