@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/accept/add?openid='.$openid,'files'=>true,'data-ajax'=>'false')) }}

    {{ Form::hidden('openid', $openid) }}
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户信息</li>
    	<li>
		{{ Form::label('name', '姓名',array('class'=>'ui-hidden-accessible')) }}
		{{ Form::text('name','',array('placeholder'=>'姓名')) }}
		</li>
		<li>
		{{ Form::label('phone', '联系号码',array('class'=>'ui-hidden-accessible')) }}
		{{ Form::text('phone','',array('placeholder'=>'联系号码')) }}
		</li>
		<li data-role="list-divider">地址</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('community', $communityEnums)}}</div>
			    <div class="ui-block-b">{{ Form::select('area', $areaEnums,'')}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('building', $buildingEnums)}}</div>
			    <div class="ui-block-b">{{ Form::select('unit', $unitEnums)}}</div>
			</div>
		</li>
		<li>
			{{ Form::label('room', '房间',array('class'=>'ui-hidden-accessible')) }}
			{{ Form::text('room','',array('placeholder'=>'房间')) }}
		</li>
		<li data-role="list-divider">投诉内容</li>
		<li>
			{{ Form::textarea('content') }}
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

     <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">投诉性质</li>
    	<li class="ui-field-contain">
		{{ Form::select('from', H::prepend($fromEnums,'信息来源'),'',array('data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('degree',H::prepend($degreeEnums,'严重程度'),'',array('data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('type',H::prepend($typeEnums,'投诉类别'),'',array('data-native-menu'=>'false'))}}
		</li>
	 </ul>

	 <ul data-role="listview" data-inset="true">
	 	<li data-role="list-divider">流程方案</li>
		<li>
		<p>下一步流程:{{$stateBeg->name}}</p>
		{{ Form::hidden('next_state_id',$stateBeg->id)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('tag_key',H::prepend($tagSet,'流程标签'),'',array('id'=>'tag_key','data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('next_id',H::prepend(array(),'下一步处理人'),'',array('id'=>'next_id','data-native-menu'=>'false'))}}
		</li>
	 </ul>


	<p>{{ Form::submit('提交') }}</p>

	{{ Form::close() }}
	</div>
	<script type="text/javascript">
	$(function(){
		var nextSet={{$stateBeg->stateUser->toJson()}};
		$("#tag_key").change(function(){
			var select=$("#next_id");
			select.find("option").remove();
			var tag=$(this).val()
			$.each(nextSet,function(n,obj){
				if(obj.tag_key==tag){
					select.append("<option value='"+obj.user_id+"'>"+obj.user_name+"</option>");
				}
			});
			select.selectmenu();
			select.selectmenu('refresh', true);
		});
		$("#tag_key").triggerHandler('change');
	})
	</script>
</div>

@stop