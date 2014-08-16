@extends('layouts.mobile')

@section('content')
<div data-role="page">
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
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/register?'.$param,'data-ajax'=>'true')) }}

	<ul data-role="listview" data-inset="true">
	 	<li class="ui-field-contain">
		{{ Form::select('type',H::prepend($typeEnums,'用户类型'),'',array('id'=>'type','data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::text('name','',array('placeholder'=>'姓名')) }}
		</li>
		<li class="ui-field-contain">
		{{ Form::text('phone','',array('placeholder'=>'联系号码')) }}
		</li>
		<li class="ui-field-contain">
		{{ Form::text('email','',array('placeholder'=>'邮箱')) }}
		</li>

		<li id="div_idcard" class="ui-field-contain">
		{{ Form::text('idcard','',array('placeholder'=>'身份证')) }}
		</li>
	</ul>
	<p>{{ Form::submit('注册') }}</p>

	{{ Form::close() }}
	</div>
</div>
@stop