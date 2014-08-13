@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/binduser','data-ajax'=>'true')) }}

	{{ Form::hidden('openid',$openid)}}
	{{ Form::hidden('syuser_id',$syuser->id)}}
	<ul data-role="listview" data-inset="true">
		<li data-role="list-divider">内部员工绑定</li>
		<li class="ui-field-contain">
		{{ Form::label('name', '姓名') }}
		{{ Form::text('name',$syuser->name) }}
		</li>
	</ul>
	<p>{{ Form::submit('绑定') }}</p>

	{{ Form::close() }}
	</div>
</div>
@stop