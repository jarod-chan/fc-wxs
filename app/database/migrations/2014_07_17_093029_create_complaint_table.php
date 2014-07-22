<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//客户投诉表
		Schema::create('wx_complaint', function($table)
		{
			$table->increments('id');//自增id 
			$table->string('name');//姓名
			$table->string('phone');//电话
			$table->string('address');//地址
			$table->string('content',512);//内容
			$table->string('state');//状态 ：未处理   已处理   已拒绝
		});
		

		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wx_complaint');
	}

}
