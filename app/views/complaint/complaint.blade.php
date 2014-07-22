@extends('layouts.main')



@section('content')
<script type="text/javascript">
	$(function(){
		$("#type").change(function(){
			if($(this).val()=='yz'){
				$("#idcard").val("");
				$("#div_idcard").show();
			}else{
				$("#idcard").val("");
				$("#div_idcard").hide();
			}
		})
	})		
</script>

	{{ Form::open(array('url' => 'complaint', 'files'=>true)) }}
	{{ Form::hidden('openid', $openid) }}
   
	{{ Form::label('name', '姓名:') }}
	{{ Form::text('name',$wxUser->name) }}
	<br/>
	
	{{ Form::label('phone', '电话:') }}
	{{ Form::text('phone',$wxUser->phone) }}
	<br/>

	{{ Form::label('address', '地址:') }}
	{{ Form::text('address',$wxUser->address) }}
	<br/>
	
	{{ Form::label('content', '内容:') }}
	{{ Form::textarea('content') }}
	<br/>	
	
	{{Form::file('file[]', array('multiple'=>true))}}
	
	<p>{{ Form::submit('提交') }}</p>

	{{ Form::close() }}	

@stop