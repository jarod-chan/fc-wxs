@extends('layouts.mobile')

@section('content')
<div data-role="page" class="cl_complaint">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/complaint', 'files'=>true,'data-ajax'=>'true')) }}
	{{ Form::hidden('openid', $openid) }}
    <ul data-role="listview" data-inset="true">
      <li data-role="list-divider">客户信息</li>
      <li class="ui-field-contain">
		{{ Form::text('name',$wxUser->name,array('placeholder'=>'姓名','id'=>'name')) }}
     </li>
	 <li class="ui-field-contain">
		{{ Form::text('phone',$wxUser->phone,array('placeholder'=>'电话','id'=>'phone')) }}
	</li>
	 <li class="ui-field-contain">
		{{ Form::select('room_id',H::prepend($roomSet,'我的房产'),$wxUser->defroom_id,array('data-native-menu'=>'false','id'=>'room_id'))}}
	</li>
	<li data-role="list-divider">投诉内容</li>
	<li>
	{{ Form::textarea('content','',array('id'=>'content')) }}
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

	@include('common.pop')

	<script type="text/javascript">
		$(function(){
			var page= $(".cl_complaint").last();
			page.find('form').submit(function(){
				var msg="";
				msg+=V.require(page.find('#name'),'姓名');
				msg+=V.require(page.find('#phone'),'电话');
				msg+=V.require(page.find('#content'),'投诉内容');
				if(msg!==""){
					pop.open(msg);
					return false;
				}
			});
		})
	</script>
  </div>
</div>

@stop