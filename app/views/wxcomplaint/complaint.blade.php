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
	<li>
	{{ Form::textarea('content','') }}
	<div class="ui-grid-a plug-fileup">
		<div class="up_file_div"></div>
		<div class="add_img_div"><input class="fileinput" data-role="none"  type="file" ></div>
	</div>
	<script type="text/javascript">
		var plug_fileup=$('.plug-fileup').last();
		var fileup=initFile(plug_fileup);
		plug_fileup.find(".fileinput").tap(fileup);
	</script>
	</li>
	</ul>


	<p>{{ Form::submit('提交') }}</p>

	{{ Form::close() }}
  </div>
</div>

@stop