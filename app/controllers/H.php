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
}

