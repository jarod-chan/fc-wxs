<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('wxuser/register','WxUserController@register');

Route::post('wxuser/register','WxUserController@registerPost');

Route::post('wxuser/update','WxUserController@updatePost');


Route::get('complaint','ComplaintController@complaint');

Route::post('complaint','ComplaintController@complaintPost');



Route::get('complaint/list','ComplaintController@index');

Route::get('complaint/deal/{id}','ComplaintController@deal')
	->where('id', '[0-9]+');

Route::post('complaint/deal/{id}','ComplaintController@dealPost')
	->where('id', '[0-9]+');
	
Route::get('accept/list','AcceptController@index');

Route::get('accept/deal/{id}','AcceptController@deal')
	->where('id', '[0-9]+');

Route::post('accept/deal/{id}','AcceptController@dealPost')
	->where('id', '[0-9]+');

Route::get('events/list','EventsController@index');





function fc_get($host,$port,$url){
		$fp = fsockopen($host, $port, $errno, $errstr, 30);
		if (!$fp) {
			$line = "error002";
		}else{
			$out = "GET $url HTTP/1.1\r\n";
			$out .= "Host: $host\r\n";
			$out.= "User-Agent: PHP Script\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$line="";
			while (!feof($fp)) {
				$get = fgets($fp, 8196);
				$line=$line.$get;
			}
			fclose($fp); 
		}
		return $line;
	}

Route::get('/', function()
{
	echo phpinfo();
	//return View::make('hello');
});


Route::get('user/list','UserController@index');


Route::get('/bd', function()
{

	/*
	  //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com");
        //curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$AppId&secret=$AppSecret");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
*/
	    $output=fc_get('localhost',80,'/la/public/user/list');
		var_dump ($output);
		 

});


Route::get('/curl', function()
{

	 //初始化
		$ch = curl_init();
		//设置选项，包括URL
		curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com");
		//curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$AppId&secret=$AppSecret");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//执行并获取HTML文档内容
		$output = curl_exec($ch);
		//释放curl句柄
		curl_close($ch);

		return $output;
});



