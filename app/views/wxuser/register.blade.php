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

	{{ Form::open(array('url' => 'wxuser/register')) }}
   
    {{ Form::hidden('openid', $openid) }}

    {{ Form::label('type', '用户类型') }}
	{{ Form::select('type', $typeEnums)}}
	<br/>

	{{ Form::label('name', '姓名') }}
	{{ Form::text('name') }}
	<br/>

	{{ Form::label('phone', '联系号码') }}
	{{ Form::text('phone') }}
	<br/>

	{{ Form::label('email', '邮箱') }}
	{{ Form::text('email') }}
	<br/>

	<div id="div_idcard">
	{{ Form::label('idcard', '身份证') }}
	{{ Form::text('idcard') }}
	</div>
	
	<p>{{ Form::submit('注册') }}</p>

	{{ Form::close() }}	

@stop