@extends('layouts.boot')



@section('content')
<div class="container">





<h1>系统用户-新增</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
{{ Form::open(array('url' => 'syuser/edit/'.$syuser->id)) }}
	 <div class='row'>
	        <div class='col-sm-6'>    
	            <div class='form-group'>
	                <label >用户名</label>
	                {{ Form::text('name',$syuser->name,array('class'=>'form-control')) }}
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
	</div>
	
	
	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('syuser/list' ) }}">返回</a>
{{ Form::close() }}	
 
 </div>
@stop