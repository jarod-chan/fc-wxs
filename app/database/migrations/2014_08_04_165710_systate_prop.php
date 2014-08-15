<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SystateProp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sy_state', function($table)
		{
			$table->string('prop')->nullable();//状态属性 beg 开始 proc 处理过程  end  结束 close 关闭
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_state', function($table)
		{
			$table->dropColumn('prop');//状态属性
		});
	}

}
