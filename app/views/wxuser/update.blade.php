@extends('layouts.mobile')



@section('content')
<div data-role="page" class="user_update">
  <div data-role="content">

	<script>
	if(!verifyCard){
		var verifyCard=function(){
			var P=$(".user_update:visible");
			if(P.find("#idcard").val()=='123456'){
				P.find("#div_idcard").hide();
				P.find("#verified").val("yes");
				P.find("#result").show();
			}else{
				alert("认证失败！");
			}
		}
	}
   </script>
	{{ Form::open(array('url' => "wx/user/info?openid=$openid")) }}
    {{ Form::hidden('verified', $wxUser->verified ,array('id'=>'verified')) }}
	<ul data-role="listview" data-inset="true">

    <li class="ui-field-contain">
    <p>用户类型:{{$wxUser->getTypeVal()}}</p>
	</li>
	 <li class="ui-field-contain">
	<p>姓名:{{$wxUser->name }} </p>
	</li>
	<li class="ui-field-contain">
	{{ Form::text('phone',$wxUser->phone,array('placeholder'=>'联系号码')) }}
	</li>
	<li class="ui-field-contain">
	{{ Form::text('email',$wxUser->email,array('placeholder'=>'邮箱')) }}
	</li>
	<li class="ui-field-contain">
	{{ Form::text('address',$wxUser->address,array('placeholder'=>'地址'))}}
	</li>

	<li class="ui-field-contain">
	{{ Form::text('profession',$wxUser->profession,array('placeholder'=>'职业'))}}
	</li>

	<li class="ui-field-contain">
	{{ Form::text('interest',$wxUser->interest,array('placeholder'=>'兴趣爱好'))}}
	</li>


	@if ($wxUser->isVerified())
	<li class="ui-field-contain">
    	<p>状态:已认证</p>
	</li>
	@else
    <li id="div_idcard" >
    	<div class="ui-field-contain">
			{{ Form::text('idcard','',array('id'=>'idcard','placeholder'=>'身份证')) }}
    	</div>
		<input id="verify_idcard" type="button" value="认证成为业主" onclick="verifyCard()">
	</li>
	<li class="ui-field-contain" id="result" style="display:none;">
		<p>状态:已认证</p>
	</li>
	@endif


 	</ul>

	<p>{{ Form::submit('更新注册信息') }}</p>

	{{ Form::close() }}
	</div>
</div>
@stop