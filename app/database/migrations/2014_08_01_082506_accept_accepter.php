<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcceptAccepter extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sy_accept', function($table)
		{
			$table->integer('accept_id')->nullable();//受理人
			$table->dateTime('create_at')->nullable();//受理时间
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
			$table->dropColumn('accept_id');
			$table->dropColumn('create_at');
		});
	}

}
