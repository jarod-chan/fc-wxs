<?php
class Events extends Eloquent{
	
	protected $table = 'wx_event';
	
	public $timestamps = false;
	
	protected $fillable = array('type','result', 'deal', 'next','create_at','commit_at','accept_id');
	
	public static function personSet(){
		return array('zs' =>'张三','ls'=>'李四','jy'=>'王五');
	}
	
	public function deal(){
		return self::personSet()[$this->deal];
	}
	
	public function next(){
		return self::personSet()[$this->next];
	}
	
	
	public static function typeSet(){
		return array('xckc' =>'现场勘查','clfa'=>'处理方案','clzx'=>'处理执行');
	}
	
	public function type(){
		return self::typeSet()[$this->type];
	}
}