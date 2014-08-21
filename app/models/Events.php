<?php
class Events extends Eloquent{

	protected $table = 'wx_event';

	public $timestamps = false;

	protected $fillable = array('state_id','result', 'deal_id', 'next_id','create_at','commit_at','accept_id','grade_id');

	public function isCommited(){
		return $this->commit_at!=null;
	}

	public function deal(){
		return $this->belongsTo('SyUser', 'deal_id');
	}

	public function next(){
		return $this->belongsTo('SyUser', 'next_id');
	}

	public function state(){
		return $this->belongsTo('State', 'state_id');
	}

	public function state_val(){
		if($this->state){
			return $this->state->name;
		}
	}

	//文件
	public function files()
	{
		return $this->morphMany('UpFile', 'fileable');
	}

}