<?php

class EasBuilding extends Eloquent {

	protected $table = 'eas_t_she_building';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2','fsellprojectid');

}
