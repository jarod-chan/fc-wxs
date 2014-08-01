<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcceptComplaintNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 DB::statement('alter table sy_accept change complaint_id complaint_id INT(11);');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('alter table sy_accept change complaint_id complaint_id INT(11) not null;');
	}

}
