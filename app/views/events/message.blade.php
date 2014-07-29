@extends('layouts.mobile')

@section('content')
<div data-role="page">
	<div data-role="content">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a">
				<h3>系统信息</h3>
			</div>
			<div class="ui-body ui-body-a">
				<p>{{ Session::get('message') }}</p>
			</div>
		</div>
		@if (Session::get('action')=='save')
			<p><a href="{{ URL::to('events/deal/' . $eventId) }}"  data-ajax='false' class="ui-btn ui-shadow ui-corner-all">点击此处跳转编辑页面</a></p>
		@endif	
	</div>
</div>
@stop