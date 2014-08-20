<?php
class UserVerify {

	public static  function isOwner($name,$idcard){
		$num = EasFdccustomer::where("fname_l2",$name)
			->where("fcertificatenumber",$idcard)
			->count();
		return $num>0;
	}

	public static function  firstRoom($name,$idcard){
		$Fdccustomer=EasFdccustomer::where("fname_l2",$name)
		->where("fcertificatenumber",$idcard)
		->first();
		return $Fdccustomer->room;
	}
}