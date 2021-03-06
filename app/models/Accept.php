<?php
class Accept extends Eloquent{

	protected $table = 'sy_accept';

	public $timestamps = false;

	protected $fillable = array('no','name', 'phone', 'community','area','building','unit','room','content','from','degree','type','complaint_id','accept_id','create_at','tag_key','state_id',"grade_id");

	public static function communityEnums(){
		return array('sj' =>'尚景','hj'=>'鸿景','jy'=>'景园');
	}

	public function community(){
		return self::communityEnums()[$this->community];
	}

	public static function areaEnums(){
		return array('a' =>'A区','b'=>'B区');
	}

	public function area(){
		return self::areaEnums()[$this->area];
	}


	public static function buildingEnums(){
		return array('20' =>'20','21'=>'21','22'=>'22');
	}

	public function building(){
		return self::buildingEnums()[$this->building];
	}

	public static function  unitEnums(){
		return  array('u1'=>'一单元','u2'=>'二单元','u3'=>'三单元');
	}

	public function unit(){
		return self::unitEnums()[$this->unit];
	}

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


	public function getAddress(){

		return $this->community().$this->area().$this->building().$this->unit().'-'.$this->room;
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
}