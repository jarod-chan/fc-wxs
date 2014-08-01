	
<div data-role="page" id="historyitem">
  <div data-role="content">
  

    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户投诉内容</li>
        <li class="ui-field-contain">
            <label>编号</label><p>{{$accept->no}}</p>
        </li>
        <li class="ui-field-contain">
            <label>姓名</label><p>{{$accept->name}}</p>
        </li>
        <li class="ui-field-contain">
        <label>联系号码</label>
  		<p>{{$accept->phone}}</p>
  		</li>
  		<li class="ui-field-contain">
  		<label>投诉内容</label>
  		<p>{{$accept->content}}</p>
        </li>
        <li class="ui-field-contain">
        	<label>附件</label>
	  		<div  class="ui-grid-a ui-responsive" >
		  	 @foreach ($acceptFiles as $file)
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


