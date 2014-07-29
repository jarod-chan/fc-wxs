<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Patch1 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//客户投诉表
		Schema::table('wx_complaint', function($table)
		{
			$table->dateTime('create_at');//创建时间
			$table->string('openid');//微信openid 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wx_complaint', function($table)
		{
		    $table->dropColumn('create_at');
		    $table->dropColumn('openid');
		});
	}

}
