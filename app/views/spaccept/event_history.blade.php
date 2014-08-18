  <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">事件列表</li>
    	@foreach ($eventHistory as $event)
    	<li class="ui-field-contain">
	      	<p style="white-space: normal;">{{$event->state->name}}:{{$event->result}}</p>
	      	<?php
 				$eventfiles=$event->event_filse();
			?>
	      	 @if(count($eventfiles)>0)
		     	 <div  class="ui-grid-a"  style="white-space: normal;">
				 @foreach ($eventfiles as $file)
			  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}" data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
				 @endforeach
	  		 	</div>
	  		 @endif
	  		<p>处理人：{{$event->deal->name}}</p>
	  		<p>提交时间：{{$event->commit_at}}</p>
		</li>
		@endforeach
 </ul>