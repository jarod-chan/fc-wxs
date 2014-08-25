<?php
class H {

	public static function prepend($arr,$tag){
		$arrTag=array(""=>$tag);
		if(!$arr) return $arrTag;
		foreach ($arr as  $k=>$v){
			$arrTag[$k]=$v;
		}
		return $arrTag;
	}

	public static function  delete($arr,$element){
		$key = array_search($element,$arr);
		if($key!==false){
			unset($arr[$key]);
		}
		return $arr;
	}
}

