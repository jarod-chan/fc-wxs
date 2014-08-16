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
		@if(isset($back))
		 <a href="#" data-role="button" data-rel="back">返回</a>
		@endif
	</div>
</div>
@stop