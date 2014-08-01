@extends('layouts.mobile')



@section('content')
<script type="text/javascript">
	$(function(){
		$("#type").change(function(){
			if($(this).val()=='yz'){
				$("#idcard").val("");
				$("#div_idcard").show();
			}else{
				$("#idcard").val("");
				$("#div_idcard").hide();
			}
		})
	})		
</script>
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'accept/add?openid=$openid','files'=>true,'data-ajax'=>'false')) }}
   
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
		{{ Form::label('next_id', '下一步处理人') }}
		{{ Form::select('next_id', $dealUserSet)}}
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