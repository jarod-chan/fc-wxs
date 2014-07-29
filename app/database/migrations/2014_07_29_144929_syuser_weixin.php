<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyuserWeixin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				//客户投诉表
		Schema::table('sy_user', function($table)
		{
			$table->string('role')->default('accept');//角色   accept 受理人  deal 处理人
			$table->string('openid')->nullable();//绑定的openid 默认为空
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_user', function($table)
		{
			$table->dropColumn('role');
			$table->dropColumn('openid');
		});
	}

}
