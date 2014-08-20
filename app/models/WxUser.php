<?php
class WxUser extends Eloquent{

	protected $table = 'wx_user';

	protected $primaryKey='openid';

	public $timestamps = false;

	protected $fillable = array('openid','type', 'name', 'phone','email','idcard','profession','interest','verified','defroom_id','address');


	static function typeEnums(){
		return array('yz' =>'业主','js'=>'业主家属','zh'=>'租户','yk'=>'游客');
	}

	public function getTypeVal(){
		$arr=array('yz' =>'业主','js'=>'业主家属','zh'=>'租户','yk'=>'游客');
		return   $arr[$this->type];
	}

	public function isVerified(){
		return $this->verified=='yes';
	}

	public function ownCustomers(){
		return EasFdccustomer::where("fcertificatenumber",$this->idcard)->get();
	}
}