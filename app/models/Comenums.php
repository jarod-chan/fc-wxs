<?php
class Comenums extends Eloquent{

	protected $table = 'sy_comenum';

	protected $primaryKey=array('key','type');

	public $timestamps = false;

	protected $fillable = array('type','key','name');

}