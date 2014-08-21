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

	//微信投诉是否已经处理
	public function isDeal(){
		return $this->state=='deal'||$this->state=='close';
	}

	//处理单
	public function  accept(){
		return $this->hasOne('Accept', 'complaint_id');
	}

	//房间
	public function room(){
		return $this->belongsTo('EasRoom', 'room_id');
	}

	//文件
	public function files()
	{
		return $this->morphMany('UpFile', 'fileable');
	}
}