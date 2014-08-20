<?php
class EasBuildingunit extends Eloquent{

	protected $table = 'eas_t_she_buildingunit';

	protected $primaryKey='fid';

	public $timestamps = false;

	protected $fillable = array('fname_l2','fbuildingid');

}