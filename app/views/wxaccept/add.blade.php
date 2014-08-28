@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	{{ Form::open(array('url' => 'wx/accept/add?openid='.$openid,'files'=>true,'data-ajax'=>'true')) }}

    {{ Form::hidden('openid', $openid) }}
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户信息</li>
    	<li>
		{{ Form::text('name','',array('placeholder'=>'姓名','id'=>'name')) }}
		</li>
		<li>
		{{ Form::text('phone','',array('placeholder'=>'联系号码','id'=>'phone')) }}
		</li>
		<li data-role="list-divider">地址</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend($sellProjectSet,'小区'),'',array('id'=>'sel_sellproject'))}}</div>
			    <div class="ui-block-b">{{ Form::select('',H::prepend(null,'楼栋'),'',array('id'=>'sel_building'))}}</div>
			</div>
		</li>
		<li>
			<div class="ui-grid-a">
			    <div class="ui-block-a">{{ Form::select('',H::prepend(null,'单元'),'',array('id'=>'sel_buildingunit'))}}</div>
			    <div class="ui-block-b">{{ Form::select('room_id',H::prepend(null,'房间'),'',array('id'=>'sel_room'))}}</div>
			</div>
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

     <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">投诉性质</li>
    	<li class="ui-field-contain">
		{{ Form::select('from', H::prepend($fromEnums,'信息来源'),'',array('id'=>'from','data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('degree',H::prepend($degreeEnums,'严重程度'),'',array('id'=>'degree','data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
		{{ Form::select('type',H::prepend($typeEnums,'诉求类别'),'',array('id'=>'type','data-native-menu'=>'false'))}}
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


	@include('common.pop')
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

		$("#sel_sellproject").change(function(){
			$("#sel_building,#sel_buildingunit,#sel_room").find("option:gt(0)").remove();
			$("#sel_building,#sel_buildingunit,#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/sel")}}',{val:$(this).val(),tag:'building'},function(data){
				var toSelect=$("#sel_building");
				for(var i=0;i<data.length;i++){
					toSelect.append($("<option value='"+data[i].id+"'>"+data[i].name+"</option>"));
				}
				toSelect.selectmenu();
				toSelect.selectmenu('refresh', true);
			});
		});

		$("#sel_building").change(function(){
			$("#sel_buildingunit,#sel_room").find("option:gt(0)").remove();
			$("#sel_buildingunit,#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/sel_buildingunit")}}',{'val':$(this).val()},function(data){
				if(data.type=="unit"){
					var toSelect=$("#sel_buildingunit");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.selectmenu('refresh', true);
				}else if(data.type=="room"){
					var toSelect=$("#sel_room");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.selectmenu('refresh', true);
				}
			});
		});

		$("#sel_buildingunit").change(function(){
			$("#sel_room").find("option:gt(0)").remove();
			$("#sel_room").selectmenu('refresh', true);
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/sel")}}',{val:$(this).val(),tag:'room'},function(data){
				var toSelect=$("#sel_room");
				for(var i=0;i<data.length;i++){
					toSelect.append($("<option value='"+data[i].id+"'>"+data[i].name+"</option>"));
				}
				toSelect.selectmenu('refresh', true);
			});
		});


		$("form").last().submit(function(){
			var msg="";
			msg+=V.require($('#name'),'姓名');
			msg+=V.require($('#phone'),'电话');
			msg+=V.require($('#sel_room'),'房间');
			msg+=V.require($('#content'),'投诉内容');
			msg+=V.require($('#from'),'信息来源');
			msg+=V.require($('#degree'),'严重程度');
			msg+=V.require($('#type'),'诉求类别');
			msg+=V.require($('#tag_key'),'流程标签');
			msg+=V.require($('#next_id'),'下一步处理人');
			if(msg!==""){
				pop.open(msg);
				return false;
			}
			return true;
		})
	})
	</script>
</div>

@stop