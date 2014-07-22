<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wx_event', function($table)
		{
			$table->increments('id');//自增id
			$table->string('type')->nullable();//事件类型 现场勘查  处理方案
			
			$table->string('result',512)->nullable();//结果记录
			$table->string('deal')->nullable();//处理人 
			$table->string('next')->nullable();//下一步处理人
			
			$table->dateTime('create_at');//创建时间
			$table->dateTime('commit_at')->nullable();//提交时间
				
			$table->integer('accept_id');//关联的受理id
				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wx_event');
	}

}
