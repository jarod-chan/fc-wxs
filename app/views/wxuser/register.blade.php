@extends('layouts.mobile')



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
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wxuser/register')) }}
   
    {{ Form::hidden('openid', $openid) }}
	<ul data-role="listview" data-inset="true">
	 	<li class="ui-field-contain">
	    {{ Form::label('type', '用户类型') }}
		{{ Form::select('type', $typeEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('name', '姓名') }}
		{{ Form::text('name') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('phone', '联系号码') }}
		{{ Form::text('phone') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('email', '邮箱') }}
		{{ Form::text('email') }}
		</li>
	
		<li id="div_idcard" class="ui-field-contain">
		{{ Form::label('idcard', '身份证') }}
		{{ Form::text('idcard') }}
		</li>
	</ul>
	<p>{{ Form::submit('注册') }}</p>

	{{ Form::close() }}	
	</div>
</div>
	
@stop