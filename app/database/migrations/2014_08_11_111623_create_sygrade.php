<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSygrade extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//评分数据库
		Schema::create('sy_grade', function($table)
		{
			$table->increments('id');//自增id
			$table->string('name');//评分名称
			$table->integer('val');//分值
			$table->string('state');//状态 yes 启用  no  禁用
			$table->softDeletes();//软删除
		});
		Schema::table('sy_accept',function ($table){
			$table->integer('grade_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_grade');
		Schema::table('sy_accept',function ($table){
			$table->dropColumn('grade_id');
		});
	}

}
