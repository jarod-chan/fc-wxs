

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">当前流程节点</li>
    	<li class="ui-field-contain">
    	<div class="ui-grid-a">
		    <div class="ui-block-a"><p>处理人:{{$event->deal->name}}</p></div>
		    <div class="ui-block-b"><p>流程:{{$event->state->name}}</p></div>
		</div>
		</li>
		<li data-role="list-divider">结果记录</li>
        <li class="ui-field-contain">
       		 <textarea cols="40" rows="8" name="result" id="result">{{$event->result}}</textarea>
       		 <div class="ui-grid-a plug-fileup">
				{{Form::hidden('delete_file_id','',array('class'=>'delete_file_id'))}}
				<div class="up_file_div">
				 @foreach ($event->files as $file)
				<div data-role="none" id="saved_{{$file->id}}" class="img_ck">
					<img  class="up_img" src="{{ URL::asset('data/'.$file->filename) }}">
					<span class="close_span" data-role="none"  onclick="remove_saved({{$file->id}})"><img data-role="none"  src="{{ URL::asset('plug/upfile/close.png') }}"></span>
				</div>
				 @endforeach
				</div>
				<div class="add_img_div"><input class="fileinput" data-role="none"  type="file" ></div>
			</div>
			<script type="text/javascript">
				var plug_fileup=$('.plug-fileup').last();
				var fileup=initFile(plug_fileup);
				plug_fileup.find(".fileinput").tap(fileup);
			</script>
        </li>

		@if($currState->isState('zrsp'))
		<!-- 主任审批 -->
		<li class="ui-field-contain">
        	  <p >下一步流程:{{$nextState->name}}</p>
        	 {{ Form::hidden('next_state_id',$nextState->id)}}
        </li>
        <li class="ui-field-contain">
        	{{ Form::select('next_id',H::prepend($nextState->stateUser->lists("user_name","user_id"),'下一步处理人'),$event->next_id,array('data-native-menu'=>'false','id'=>'next_id'))}}
        </li>
        @endif

        @if($currState->isState('fzrsp'))
        <?php
			$stateUserSet=$nextState->stateUser;
			$dealUserSet=array();
			foreach ($stateUserSet as $stateUser){
				if($event->tag_key){
					if ($stateUser->tag_key==$event->tag_key) {
						$dealUserSet[$stateUser->user_id]=$stateUser->user_name;
					}
				}
			}
		?>

        <!-- 负责人审批 -->
        <li class="ui-field-contain">
        	  <p >下一步流程:{{$nextState->name}}</p>
        	 {{ Form::hidden('next_state_id',$nextState->id)}}
        </li>
        <li class="ui-field-contain">
			{{ Form::select('tag_key',H::prepend(SyTag::lists('name','key'),'流程标签'),$event->tag_key,array('id'=>'tag_key','data-native-menu'=>'false'))}}
		</li>
		<li class="ui-field-contain">
			{{ Form::select('next_id',H::prepend($dealUserSet,'下一步处理人'),$event->next_id,array('id'=>'next_id','data-native-menu'=>'false'))}}
		</li>
		<script type="text/javascript">
		$(function(){
			var page=$(".pgcommon").last();
			var nextSet={{$nextState->stateUser->toJson()}};
			page.find("#tag_key").change(function(){
				var select=page.find("#next_id");
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

		})
		</script>
		@endif

		@if($currState->isState('qr'))
		<!-- 确认 -->
		<li class="ui-field-contain">
        	  <label >投诉处理满意度:</label>
        	  <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
			        @foreach(Grade::stateOn()->get() as $grade)
			        <input type="radio" name="grade_id" id="radio-choice-{{$grade->id}}" value="{{$grade->id}}"   @if($grade->id==$event->grade_id) checked="checked" @endif >
			        <label for="radio-choice-{{$grade->id}}">{{$grade->name}}</label>
			        @endforeach
			 </fieldset>
        </li>
		<li class="ui-field-contain">
        	  <p >下一步流程:{{$nextState->name}}</p>
        	 {{ Form::hidden('next_state_id',$nextState->id)}}
        </li>
		@endif

        <li class="ui-grid-a ui-responsive">
		    <div class="ui-block-a"><button id="btn_save" class="ui-btn  ui-shadow  ui-corner-all" >暂存</button></div>
		    <div class="ui-block-b"><button id="btn_commit" class="ui-btn  ui-shadow  ui-corner-all" >提交</button></div>
		</li>
    </ul>
