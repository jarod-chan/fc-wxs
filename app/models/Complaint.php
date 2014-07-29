<?php
//微信投诉
class Complaint extends Eloquent{
	
	protected $table = 'wx_complaint';
	
	public $timestamps = false;
	
	protected $fillable = array('name','phone', 'address', 'content','state','create_at','openid');
	
}