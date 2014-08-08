@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/accept/add?openid='.$openid,'files'=>true,'data-ajax'=>'false')) }}
   
    {{ Form::hidden('openid', $openid) }}
	<ul data-role="listview" data-inset="true">
		<li class="ui-field-contain">
		{{ Form::label('no', '编号') }}
		<p>系统自动生成</p>
		</li>
		<li class="ui-field-contain">
		{{ Form::label('name', '姓名') }}
		{{ Form::text('name') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('phone', '联系号码') }}
		{{ Form::text('phone') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('community', '社区') }}
		{{ Form::select('community', $communityEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('area', '区域') }}
		{{ Form::select('area', $areaEnums,'')}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('building', '楼号') }}
		{{ Form::select('building', $buildingEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('unit', '单元') }}
		{{ Form::select('unit', $unitEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('room', '房间') }}
		{{ Form::text('room','0') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('content', '投诉内容') }}
		{{ Form::textarea('content') }}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('from', '信息来源') }}
		{{ Form::select('from', $fromEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('degree', '严重程度') }}
		{{ Form::select('degree', $degreeEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('type', '投诉类别') }}
		{{ Form::select('type', $typeEnums)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('', '下一步流程') }}
		<p>{{$stateBeg->name}}</p>
		{{ Form::hidden('next_state_id',$stateBeg->id)}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('tag_key', '流程标签') }}
		{{ Form::select('tag_key',$tagSet,array('id'=>'tag_key'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::label('next_id', '下一步处理人') }}
		{{ Form::select('next_id',array(),array('id'=>'next_id'))}} 
		</li>
		<li class="ui-field-contain">
		{{ Form::label('file[]', '附件:') }}
		{{Form::file('file[]', array('multiple'=>true))}}
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