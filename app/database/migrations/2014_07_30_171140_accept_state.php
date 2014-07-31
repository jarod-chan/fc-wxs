<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcceptState extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sy_accept', function($table)
		{
			$table->integer('state_id')->nullable();//关联状态
		});
		
		
		Schema::table('wx_event', function($table)
		{
			if (Schema::hasColumn('wx_event', 'type'))
			{
				$table->dropColumn('type');
			}
			$table->integer('state_id')->nullable();//关联状态
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_accept',function($table){
			$table->dropColumn('state_id');
		});
		Schema::table('wx_event',function($table){
			$table->dropColumn('state_id');
		});
	}

}
