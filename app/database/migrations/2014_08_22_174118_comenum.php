<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comenum extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sy_comenum', function($table)
		{
			$table->string('type');//类型
			$table->string('key');//关键字
			$table->string('name');//显示值
			$table->primary(array('type', 'key'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_comenum');
	}

}
