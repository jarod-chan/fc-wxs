  <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">事件列表</li>
    	@foreach ($eventHistory as $event)
    	<li class="ui-field-contain">
		      <label>{{$event->state->name}}</label><p>{{$event->result}}</p>
		</li>
		@endforeach
 </ul>