<?php

class ComplaintState extends Seeder {

	public function run()
	{
		DB::table('wx_complaint') 
			->where('state', 'N/A')
            ->update(array('state' => 'wait'));
	}

}