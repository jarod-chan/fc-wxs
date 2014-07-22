<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				//受理单
		Schema::create('sy_accept', function($table)
		{
			$table->increments('id');//自增id 
			$table->string('no');//编号
			$table->string('name');//姓名
			$table->string('phone');//电话
			//格式化地址信息
			$table->string('community');//小区
			$table->string('area');//区域
			$table->string('building');//楼号
			$table->integer('room');//房间
			
			$table->string('content',512);//内容
			
			$table->string('from');//信息来源 电话 网络 书面
			$table->string('degree');//严重程度
			$table->string('type');//投诉类别
			
			$table->integer('complaint_id');//关联的投诉id
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_accept');
	}

}
