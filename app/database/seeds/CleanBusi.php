<?php

class CleanBusi extends Seeder {
	public function run()
	{
 		DB::table('wx_event')->delete();
 		echo "clean wx_event \n";
 		DB::table('sy_accept')->delete();
 		echo "clean sy_accept \n";
 		DB::table('wx_complaint')->delete();
 		echo "clean wx_complaint \n";
 		DB::table('sy_file')->delete();
 		echo "clean sy_file \n";
		$dir=public_path().DIRECTORY_SEPARATOR.'data';
		$this->delDirFile($dir);
	}

	//循环删除目录和文件函数
	public function delDirFile($dirName){
		if($handle = opendir("$dirName")){
			while(false!==($item = readdir($handle))){
				if($item != "." && $item != ".." ){
					if(is_dir("$dirName/$item")){
						delDirAndFile("$dirName/$item" );
					}else{
						if(unlink("$dirName/$item"));
					}
				}
			}
			closedir( $handle );
		}
	}

}
