
    <ul data-role="listview" data-inset="true">
     	<li class="ui-field-contain">
            <label for="type">当前处理人</label>
              <p>{{$event->deal->name}}</p>
        </li>
        <li class="ui-field-contain">
            <label for="type">任务节点</label>
              <p>{{$event->state->name}}</p>
        </li>
        <li class="ui-field-contain">
            <label for="result">结果记录</label>
       		 <textarea cols="40" rows="8" name="result" id="result">{{$event->result}}</textarea>
        </li>

        <li>
        	<div class='ui-field-contain'>
        	 <label for="file[]">附件</label>
			{{Form::file('file[]', array('multiple'=>true))}}
        	</div>
        	<div class='ui-field-contain'>
			 @foreach ($files as $file)
			  	 <a href="#{{'fl_'.$file->id}}" data-rel="popup" data-position-to="window" data-transition="fade"><img class="popphoto" src="{{ URL::asset('data/'.$file->filename) }}" style="height: 180px;"></a>
				 <div data-role="popup" id="{{'fl_'.$file->id}}" data-overlay-theme="b" data-theme="b" data-corners="false">
				    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img class="popphoto" src="{{ URL::asset('data/'.$file->filename) }}" style="max-height:512px;" alt="Paris, France">
				 </div>
			 @endforeach
	        </div>

        </li>
        @if(isset($gradeSet))
 		<li class="ui-field-contain">
        	  <label >投诉处理满意度</label>
        	  <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
			        @foreach($gradeSet as $grade)
			        <input type="radio" name="grade_id" id="radio-choice-{{$grade->id}}" value="{{$grade->id}}"   @if($grade->id==$event->grade_id) checked="checked" @endif >
			        <label for="radio-choice-{{$grade->id}}">{{$grade->name}}</label>
			        @endforeach
			 </fieldset>
        </li>
        @endif
         <li class="ui-field-contain">
        	  <label >流程标签</label>
        	  <p>{{$accept->tag->name}}</p>
        </li>
        <li class="ui-field-contain">
        	  <label >下一步流程</label>
        	 <p>{{$nextState->name}}</p>
        	 {{ Form::hidden('next_state_id',$nextState->id)}}
        </li>
        @if(!$nextState->isEnd())
        <li class="ui-field-contain">
        	<label for="next">下一步处理人</label>
        	{{ Form::select('next_id',$dealUserSet,$event->next_id)}}
        </li>
        @endif
        <li class="ui-grid-a ui-responsive">
		    <div class="ui-block-a"><button id="btn_save" class="ui-btn  ui-shadow  ui-corner-all" >暂存</button></div>
		    <div class="ui-block-b"><button id="btn_commit" class="ui-btn  ui-shadow  ui-corner-all" >提交</button></div>
		</li>
    </ul>
