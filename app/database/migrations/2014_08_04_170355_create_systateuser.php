<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystateuser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sy_state_user', function($table)
		{
			$table->increments('id');//自增id
			$table->integer('state_id');//关联的状态id
			$table->integer('user_id');//关联的状态id
			$table->string('tag_key');//系统标签
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_state_user');
	}

}
