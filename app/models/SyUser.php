<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class SyUser extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sy_user';

	/**
	 * The attributes excluded from the model's JSON form.
	 * 取回密码的时候用
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');//protected $hidden = array('password', 'remember_token');

	protected $fillable = array('name','email','password','role','openid');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function roleEnums(){
		return array('admin'=>'管理员','deal'=>'处理人');
	}

	public function role(){
		return self::roleEnums()[$this->role];
	}

	//范围查询
	public function scopeDealUser($query)
	{
		return $query->where('role','deal');
	}

	public function scopeAcceptUser($query)
	{
		return $query->where('role','accept');
	}

	//是否分配了某个流程状态，用来判断菜单的加载
	//$propStr为状态字符串
	public function inState($propStr){
		$userIds=State::where('prop',$propStr)->first()->stateUser->lists('user_id');
		return in_array($this->id,$userIds);
	}

}
