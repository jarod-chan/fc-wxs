@extends('layouts.boot')



@section('content')
<div class="container">





<h1>系统用户-新增</h1>

@include('common.alert')

{{ Form::open(array('url' => 'syuser/save')) }}

  	{{ Form::hidden('id',$syuser->id) }}
	 <div class='row'>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >用户名</label>
	                {{ Form::text('name',$syuser->name,array('class'=>'form-control')) }}
	            </div>
	        </div>
	         <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >密码</label>
	                {{ Form::text('password','',array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >邮箱</label>
	                 {{ Form::text('email',$syuser->email,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >角色</label>
	                {{ Form::select('role',$roleEnums,$syuser->role,array('class'=>'form-control'))}}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >微信id</label>
	                 {{ Form::text('openid',$syuser->openid,array('class'=>'form-control')) }}
	            </div>
	        </div>
	</div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('syuser/list' ) }}">返回</a>
{{ Form::close() }}

 </div>
@stop