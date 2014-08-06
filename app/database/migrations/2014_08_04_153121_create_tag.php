<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTag extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sy_tag', function($table)
		{
			$table->string('key');
			$table->string('name');
			
			$table->primary('key');//key 作为主键
		});
		
		DB::table('sy_tag')->insert(array(
		    array('key' => 'real', 'name' =>'房产'),
		    array('key' => 'prop', 'name' => '物业'),
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sy_tag');
	}

}
