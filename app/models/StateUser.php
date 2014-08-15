<?php
class StateUser extends Eloquent{
	
	protected $table = 'sy_state_user';
	
	public $timestamps = false;
	
	protected $fillable = array('state_id','user_id','tag_key');
	
	protected $appends = array('user_name');
	
	protected $hidden = array('user');
	
	public function user(){
		return $this->belongsTo('SyUser', 'user_id');
	}
	
	public function getUserNameAttribute(){
		return $this->user->name;
	}
	
}