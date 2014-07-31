<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class EventsDealid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				//客户投诉表
		Schema::table('wx_event', function($table)
		{
			if (Schema::hasColumn('wx_event', 'deal'))
			{
				$table->dropColumn('deal');
			}
			if (Schema::hasColumn('wx_event', 'next'))
			{
				$table->dropColumn('next');
			}
			$table->integer('deal_id')->nullable();//关联用户
			$table->integer('next_id')->nullable();//关联用户
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('wx_event',function($table){
			$table->dropColumn('deal_id');
			$table->dropColumn('next_id');
		});
	}

}
