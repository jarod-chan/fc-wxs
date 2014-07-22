<?php
class Events extends Eloquent{
	
	protected $table = 'wx_event';
	
	public $timestamps = false;
	
	protected $fillable = array('type','result', 'deal', 'next','create_at','commit_at','accept_id');
}