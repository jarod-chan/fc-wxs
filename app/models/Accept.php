<?php
class Accept extends Eloquent{

	protected $table = 'sy_accept';

	public $timestamps = false;

	protected $fillable = array('name','phone','content','from','degree','type','complaint_id','accept_id','create_at','tag_key','state_id'
			,'grade_id','room_id');


	public static function fromEnums(){
		return Syenum::vals('accept_from');
	}

	public function from(){
		return Syenum::key('accept_from',$this->from);
	}

	public static function degreeEnums(){
		return Syenum::vals('accept_degree');
	}

	public function degree(){
		return Syenum::key('accept_degree',$this->degree);
	}

	public static function typeEnums(){
		return Syenum::vals('accept_type');
	}

	public function type(){
		return Syenum::key('accept_type',$this->type);
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