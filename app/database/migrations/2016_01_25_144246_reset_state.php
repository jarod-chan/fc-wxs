<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResetState extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::statement("insert into `sy_state`(`id`,`no`,`name`,`deleted_at`,`prop`) values (1,1,'受理',null,'init')");
		DB::statement("insert into `sy_state`(`id`,`no`,`name`,`deleted_at`,`prop`) values (2,2,'方案制定',null,'beg')");
		DB::statement("insert into `sy_state`(`id`,`no`,`name`,`deleted_at`,`prop`) values (3,3,'方案执行',null,'proc')");
		DB::statement("insert into `sy_state`(`id`,`no`,`name`,`deleted_at`,`prop`) values (4,4,'确认',null,'grade')");
		DB::statement("insert into `sy_state`(`id`,`no`,`name`,`deleted_at`,`prop`) values (5,5,'关闭',null,'end')");

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("delete from `sy_state` where id in (1,2,3,4,5) ");
	}

}
