@extends('layouts.mobile')

@section('content')
<div data-role="page">
	<div data-role="content">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a">
				<h3>系统信息</h3>
			</div>
			<div class="ui-body ui-body-a">
				<p>您好，由于您是未注册用户，无法进行相关操作。</p>
			</div>
		</div>
		<p><a href="{{ URL::to('wx/register?'.$param) }}"  data-ajax='true' class="ui-btn ui-shadow ui-corner-all">点击此处跳转注册页面</a></p>
	</div>
</div>
@stop