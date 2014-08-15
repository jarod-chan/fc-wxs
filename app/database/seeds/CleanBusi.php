<?php

class CleanBusi extends Seeder {
	public function run()
	{
		DB::table('wx_event')->delete();
		DB::table('sy_accept')->delete();
		DB::table('wx_complaint')->delete();
		DB::table('sy_file')->delete();
	}
}
