
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
       		 <div class="ui-grid-a">
       		 	{{Form::file('file[]', array('multiple'=>true))}}
       		 </div>
       		 <div  class="ui-grid-a"  style="white-space: normal;">
			 @foreach ($files as $file)
		  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}" data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
			 @endforeach
	  		</div>
        </li>

        @if(isset($gradeSet))
 		<li class="ui-field-contain">
        	  <label >投诉处理满意度:</label>
        	  <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
			        @foreach($gradeSet as $grade)
			        <input type="radio" name="grade_id" id="radio-choice-{{$grade->id}}" value="{{$grade->id}}"   @if($grade->id==$event->grade_id) checked="checked" @endif >
			        <label for="radio-choice-{{$grade->id}}">{{$grade->name}}</label>
			        @endforeach
			 </fieldset>
        </li>
        @endif

        <li class="ui-field-contain">
        	  <p >下一步流程:{{$nextState->name}}</p>
        	 {{ Form::hidden('next_state_id',$nextState->id)}}
        </li>
        @if(!$nextState->isEnd())
        <li class="ui-field-contain">
        	<label for="next">下一步处理人:</label>
        	{{ Form::select('next_id',$dealUserSet,$event->next_id)}}
        </li>
        @endif
        <li class="ui-grid-a ui-responsive">
		    <div class="ui-block-a"><button id="btn_save" class="ui-btn  ui-shadow  ui-corner-all" >暂存</button></div>
		    <div class="ui-block-b"><button id="btn_commit" class="ui-btn  ui-shadow  ui-corner-all" >提交</button></div>
		</li>
    </ul>
