  <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">事件列表</li>
    	@foreach ($eventHistory as $event)
    	<li>
    		 <div class="ui-field-contain">
		      <label>{{$event->state->name}}</label><p>{{$event->result}}</p>
		     	 <div  class="ui-grid-a"  style="white-space: normal;">
				 @foreach ($event->event_filse() as $file)
			  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}" data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
				 @endforeach
		  		</div>
		  		<p>处理人：{{$event->deal->name}}</p>
		  		<p>提交时间：{{$event->commit_at}}</p>
		     </div>
		</li>
		@endforeach
 </ul>