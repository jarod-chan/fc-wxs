@extends('layouts.main')



@section('content')
<script type="text/javascript">
	$(function(){
		$("#verify_idcard").click(function(){
			if($("#idcard").val()=='123456'){
				$("#div_idcard").hide();
				$("#verified").val("yes");
				$("#result").show();
			}else{
				alert("认证失败！");
			}
		});
	})		
</script>

	{{ Form::open(array('url' => 'wxuser/update')) }}
   
    {{ Form::hidden('openid', $openid) }}

    {{ Form::hidden('verified', $wxUser->verified ,array('id'=>'verified')) }}

    {{ Form::label('type', '用户类型:') }}
	{{$wxUser->getTypeVal()}}
	<br/>
	
	{{ Form::label('name', '姓名:') }}
	{{$wxUser->name }} 
	<br/>

	{{ Form::label('phone', '联系号码:') }}
	{{ Form::text('phone',$wxUser->phone) }}
	<br/>

	{{ Form::label('email', '邮箱:') }}
	{{ Form::text('email',$wxUser->email) }}
	<br/>
	
	{{ Form::label('address', '地址:') }}
	{{ Form::text('address',$wxUser->address)}}
	<br/>

	{{ Form::label('profession', '职业:') }}
	{{ Form::text('profession',$wxUser->profession)}}
	<br/>

	{{ Form::label('interest', '兴趣爱好:') }}
	{{ Form::text('interest',$wxUser->interest)}}
	<br/>

	
	@if ($wxUser->isVerified())
    	{{ Form::label('verified', '状态:') }}已认证
	@else
	    <div id="div_idcard">
			{{ Form::label('idcard', '身份证:') }}
			{{ Form::text('idcard') }}
			<input id="verify_idcard" type="button" value="认证成为业主">
		</div>
		<div id="result" style="display:none;">
			{{ Form::label('verified', '状态:') }}已认证
		</div>
	@endif



	
	<p>{{ Form::submit('更新注册信息') }}</p>

	{{ Form::close() }}	

@stop