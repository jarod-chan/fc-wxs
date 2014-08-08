@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/complaint', 'files'=>true,'data-ajax'=>'false')) }}
	{{ Form::hidden('openid', $openid) }}
    <ul data-role="listview" data-inset="true">
      <li class="ui-field-contain">
        {{ Form::label('name', '姓名:') }}
		{{ Form::text('name',$wxUser->name) }}
     </li>
	 <li class="ui-field-contain">
		{{ Form::label('phone', '电话:') }}
		{{ Form::text('phone',$wxUser->phone) }}
	</li>
	 <li class="ui-field-contain">
		{{ Form::label('address', '地址:') }}
		{{ Form::text('address',$wxUser->address) }}
	</li>
	<li class="ui-field-contain">
	{{ Form::label('content', '内容:') }}
	{{ Form::textarea('content') }}
	</li>
	<li class="ui-field-contain">
	{{ Form::label('file[]', '附件:') }}
	{{Form::file('file[]', array('multiple'=>true))}}
	</li>
	</ul>

	
	<p>{{ Form::submit('提交') }}</p>

	{{ Form::close() }}	
  </div>
</div>
	
@stop