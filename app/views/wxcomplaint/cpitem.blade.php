
<div data-role="page">
	<div data-role="content">
	    <ul data-role="listview" data-inset="true">
	    	<li data-role="list-divider">投诉详细信息</li>
	        <li class="ui-field-contain">
	            <label>内容</label><p style="white-space: normal;">{{$complaint->content}}</p>
	        </li>
	        <li class="ui-field-contain">
	            <label>投诉时间</label><p>{{ $complaint->create_at }}</p>
	        </li>
	         <li class="ui-field-contain">
	            <label>状态</label><p>{{ $complaint->state() }}</p>
	        </li>
	        <li class="ui-field-contain">
        	<label>附件</label>
	  		<div  class="ui-grid-a " style="white-space: normal;" >
				@foreach ($files  as $file)
			  	 <a href="#{{'fl_'.$file->id}}" data-rel="popup" data-position-to="window" data-transition="fade"><img class="popphoto" src="{{ URL::asset('data/'.$file->filename) }}" style="height: 180px;"></a>
				 <div data-role="popup" id="{{'fl_'.$file->id}}" data-overlay-theme="b" data-theme="b" data-corners="false">
				    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img class="popphoto" src="{{ URL::asset('data/'.$file->filename) }}" style="max-height:512px;" alt="Paris, France">
				 </div>
				@endforeach
	  		</div>
        </li>
	    </ul>
	    
	    <ul data-role="listview" data-inset="true">
	    	<li data-role="list-divider">事件列表</li>
	    	@foreach ($eventHistory as $event)
	    	<li class="ui-field-contain">
			      <label>{{$event->state->name}}</label><p>{{$event->result}}</p>
			</li>
			@endforeach
		 </ul>
	     <a href="#" data-role="button" data-rel="back">返回</a>
	</div>
</div>