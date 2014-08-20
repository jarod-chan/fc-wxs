@extends('layouts.mobile')



@section('content')
<div data-role="page" class="user_update">
  <div data-role="content">

	<script>

	$(function(){
		var P=$(".user_update").last();
	    P.find("#vf_button").click(function(){
		    var param={name:P.find("#vf_name").val(),idcard:P.find("#vf_card").val()};
			$.post('{{URL::to("wx/user/verify?openid=$openid")}}',param,function(data){
				if(data.result){
					P.find("#hd_verified").val("yes");
					P.find("#row_vf").hide();
					P.find("#row_sh").show();
					alert("认证通过！点击【更新注册信息】同步您的房产信息。");
				}else{
					alert("认证失败！请确认你的真实姓名，身份证信息是正确的。");
				}
			});
		});
	})
   </script>
	{{ Form::open(array('url' => "wx/user/info?openid=$openid")) }}
    {{ Form::hidden('need_verified','no' ,array('id'=>'hd_verified')) }}
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
    <li id="row_vf" >
    	<div class="ui-field-contain">
    		{{ Form::text('vf_name',$wxUser->name,array('id'=>'vf_name','placeholder'=>'真实姓名')) }}
			{{ Form::text('vf_card','',array('id'=>'vf_card','placeholder'=>'身份证')) }}
    	</div>
		<input id="vf_button" type="button" value="认证成为业主" >
	</li>
	<li id="row_sh" style="display:none;">
		<p>点击【更新注册信息】同步您的房产信息。</p>
	</li>
	@endif
 	</ul>

 	@if ($wxUser->isVerified())
	<div class="ui-corner-all custom-corners">
	  <div class="ui-bar ui-bar-a">
	    <h3>房产信息</h3>
	  </div>
	  <div class="ui-body ui-body-a">
	    <fieldset data-role="controlgroup">
	   		<legend>选择您的默认房产:</legend>
	        @foreach($wxUser->ownCustomers() as $customer)
	        <input type="radio" name="defroom_id" id="rd_{{$customer->room->fid}}" value="{{$customer->room->fid}}" @if($customer->room->fid==$wxUser->defroom_id) checked="checked" @endif>
       		<label for="rd_{{$customer->room->fid}}">{{ $customer->room->address()}}</label>
	        @endforeach
		</fieldset>
	  </div>
	</div>
	@endif



	<p>{{ Form::submit('更新注册信息') }}</p>

	{{ Form::close() }}
	</div>
</div>
@stop