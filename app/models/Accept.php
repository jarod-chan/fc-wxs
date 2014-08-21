<?php
class Accept extends Eloquent{

	protected $table = 'sy_accept';

	public $timestamps = false;

	protected $fillable = array('no','name','phone','content','from','degree','type','complaint_id','accept_id','create_at','tag_key','state_id'
			,'grade_id','room_id');


	public static function fromEnums(){
		return array('phone' =>'电话','net'=>'网络','book'=>'书面');
	}

	public function from(){
		return self::fromEnums()[$this->from];
	}

	public static function degreeEnums(){
		return array('general' =>'一般','serious'=>'严重');
	}

	public function degree(){
		return self::degreeEnums()[$this->degree];
	}

	public static function typeEnums(){
		return array('gczl' =>'工程质量','ghsj'=>'规划设计','xsfw'=>'销售服务');
	}

	public function type(){
		return self::typeEnums()[$this->type];
	}

	public function state(){
		return $this->belongsTo('State', 'state_id');
	}


	public function events()
	{
		return $this->hasMany('Events','accept_id');
	}

	public function tag(){
		return $this->belongsTo('SyTag', 'tag_key');
	}

	public function grade(){
		return $this->belongsTo('SyGrade', 'grade_id');
	}

	public function room(){
		return $this->belongsTo('EasRoom','room_id');
	}

	//文件
	public function files()
	{
		return $this->morphMany('UpFile', 'fileable');
	}
}