@extends('layouts.mobile')



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
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/user/info?openid='.$openid)) }}
<!--     {{ Form::hidden('openid', $openid) }} -->
    {{ Form::hidden('verified', $wxUser->verified ,array('id'=>'verified')) }}
	<ul data-role="listview" data-inset="true">

    <li class="ui-field-contain">
    {{ Form::label('type', '用户类型:') }} <p>{{$wxUser->getTypeVal()}}</p>
	</li>
	 <li class="ui-field-contain">
	{{ Form::label('name', '姓名:') }}<p>{{$wxUser->name }} </p>
	</li>
	<li class="ui-field-contain">
	{{ Form::label('phone', '联系号码:') }}
	{{ Form::text('phone',$wxUser->phone) }}
	</li>
	<li class="ui-field-contain">
	{{ Form::label('email', '邮箱:') }}
	{{ Form::text('email',$wxUser->email) }}
	</li>
	<li class="ui-field-contain">
	{{ Form::label('address', '地址:') }}
	{{ Form::text('address',$wxUser->address)}}
	</li>

	<li class="ui-field-contain">
	{{ Form::label('profession', '职业:') }}
	{{ Form::text('profession',$wxUser->profession)}}
	</li>

	<li class="ui-field-contain">
	{{ Form::label('interest', '兴趣爱好:') }}
	{{ Form::text('interest',$wxUser->interest)}}
	</li>


	@if ($wxUser->isVerified())
	<li class="ui-field-contain">
    	{{ Form::label('verified', '状态:') }}<p>已认证</p>
	</li>
	@else

	    <li id="div_idcard" >
	    	<div class="ui-field-contain">
		    	{{ Form::label('idcard', '身份证:') }}
				{{ Form::text('idcard') }}
	    	</div>
			<input id="verify_idcard" type="button" value="认证成为业主">
		</li>
		<li class="ui-field-contain" id="result" style="display:none;">
			{{ Form::label('verified', '状态:') }}<p >已认证</p>
		</li>
	@endif


 	</ul>

	<p>{{ Form::submit('更新注册信息') }}</p>

	{{ Form::close() }}
	</div>
</div>
@stop