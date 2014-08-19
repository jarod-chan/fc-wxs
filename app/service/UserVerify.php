<?php
class UserVerify {

	public static  function isOwner($idcard){
		return !empty($idcard) && $idcard=='123456';
	}
}