@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/complaint', 'files'=>true,'data-ajax'=>'false')) }}
	{{ Form::hidden('openid', $openid) }}
    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">客户信息</li>
      <li class="ui-field-contain">
		{{ Form::text('name',$wxUser->name,array('placeholder'=>'姓名')) }}
     </li>
	 <li class="ui-field-contain">
		{{ Form::text('phone',$wxUser->phone,array('placeholder'=>'电话')) }}
	</li>
	 <li class="ui-field-contain">
		{{ Form::text('address',$wxUser->address,array('placeholder'=>'地址')) }}
	</li>
	<li data-role="list-divider">投诉内容</li>
	<li class="ui-field-contain">
	{{ Form::textarea('content','') }}
	{{Form::file('file[]', array('multiple'=>true))}}
	</li>
	</ul>


	<p>{{ Form::submit('提交') }}</p>

	{{ Form::close() }}
  </div>
</div>

@stop