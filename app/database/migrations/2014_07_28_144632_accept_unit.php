<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcceptUnit extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//客户投诉表
		Schema::table('sy_accept', function($table)
		{
			$table->string('unit')->default('u1');//单元
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sy_accept', function($table)
		{
		    $table->dropColumn('unit');
		});
	}

}
