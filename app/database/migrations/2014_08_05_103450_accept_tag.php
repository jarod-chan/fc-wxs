<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AcceptTag extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sy_accept', function($table)
		{
			$table->string('tag_key')->nullable();//状态属性 beg 开始 proc 处理过程  end  结束 close 关闭
		});
		DB::table('sy_accept')
			->whereNull('tag_key')
			->update(array('tag_key' => 'real'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_accept',function ($table){
			$table->dropColumn('tag_key');
		});
	}

}
