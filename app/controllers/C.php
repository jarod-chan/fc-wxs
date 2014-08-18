<?php
class C {

	public static function save_files($tablename,$pkid,$filestrSet){
		foreach ($filestrSet as $filestr){
			$filename=self::save_file_to_disk($filestr);
			self::save_file_to_db($tablename,$pkid,$filename);
		}
	}

	private static function save_file_to_disk($filestr){
		list($type, $filestr) = explode(';', $filestr);
		list(, $type) = explode('/', $type);
		list(, $filestr) = explode(',', $filestr);
		$filestr = base64_decode($filestr);

		$filename=uniqid(date('Ymd-')).'.'.$type;
		$filepath=public_path().'/data/'.$filename;

		file_put_contents($filepath, $filestr);
		return $filename;
	}

	private static function save_file_to_db($tablename,$pkid,$filename){
		$arr=array(
				'tabname'=>$tablename,
				'pkid'=>$pkid,
				'filename'=>$filename
		);
		UpFile::create($arr);
	}

	public static function remove_filse($fmtFileIds){
		$idset=explode("|",$fmtFileIds);
		array_shift($idset);
		if(count($idset)>0){
			UpFile::destroy($idset);
		}
	}

}