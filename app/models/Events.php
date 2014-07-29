<?php
class Events extends Eloquent{
	
	protected $table = 'wx_event';
	
	public $timestamps = false;
	
	protected $fillable = array('type','result', 'deal_id', 'next_id','create_at','commit_at','accept_id');
	
	public function isCommited(){
		return $this->commit_at!=null;
	}
	
	public function deal(){
		return $this->belongsTo('SyUser', 'deal_id');
	}
	
	public function next(){
		return $this->belongsTo('SyUser', 'next_id');
	}
	
	
	public static function typeSet(){
		return array('xckc' =>'现场勘查','clfa'=>'处理方案','clzx'=>'处理执行');
	}
	
	public function type(){
		return self::typeSet()[$this->type];
	}
	
	
}