<?php
//文件附件表
class UpFile extends Eloquent{

	protected $table = 'sy_file';

	public $timestamps = false;

	protected $fillable = array('tabname','pkid', 'filename','fileable_id','fileable_type');

	public function fileable()
	{
		return $this->morphTo();
	}

}