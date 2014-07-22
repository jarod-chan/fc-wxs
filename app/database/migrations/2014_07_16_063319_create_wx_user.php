<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wx_user', function($table)
		{
			$table->string('openid');//微信openid 
			$table->string('type');//类型:yz业主，js业主家属，zh租户
			$table->string('name');//姓名
			$table->string('phone');//联系号码
			$table->string('email');//邮箱
			$table->string('address')->nullable();//地址
			$table->string('idcard')->nullable();//身份证
			$table->string('profession')->nullable();//专业
			$table->string('interest')->nullable();//爱好
			$table->string('verified');//是否认证
			$table->string('address_def')->nullable();//默认地址，保留作认证用

			$table->primary('openid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wx_user');
	}

}
