<?php
//微信投诉
class Complaint extends Eloquent{

	protected $table = 'wx_complaint';

	public $timestamps = false;

	protected $fillable = array('name','phone', 'address', 'content','state','create_at','openid','room_id');

	public static function  stateEnums(){
			return array('wait' =>'待处理','deal'=>'已受理','close'=>'关闭');
	}

	public function state(){
		if($this->accept&&$this->accept->state){
 			return $this->accept->state->name;
 		}
		return self::stateEnums()[$this->state];
	}

	public function isDeal(){
		return $this->state=='deal'||$this->state=='close';
	}

	public function  accept(){
		return $this->hasOne('Accept', 'complaint_id');
	}

	public function room(){
		return $this->belongsTo('EasRoom', 'room_id');
	}
}