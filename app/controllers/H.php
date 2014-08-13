<?php
class H {

	public static function prepend($arr,$tag){
		$arrTag=array(""=>$tag);
		if(!$arr) return $arrTag;
		return array_merge($arrTag,$arr);
	}
}

