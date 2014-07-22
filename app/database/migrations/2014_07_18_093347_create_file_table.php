<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//上传文件表
		Schema::create('sy_file', function($table)
		{
			$table->increments('id');//自增id
			$table->string('tabname');//文件关联的对象类型
			$table->integer('pkid');//关联id
			$table->string('filename');//文件名
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_file');
	}

}
