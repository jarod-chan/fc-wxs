@extends('layouts.mobile')



@section('content')
<div data-role="page">
	<div data-role="content">
	    <ul data-role="listview" data-inset="true">
	    	<li data-role="list-divider">投诉详细信息</li>
	        <li class="ui-field-contain">
	            <label>内容</label><p style="white-space: normal;">{{$complaint->content}}</p>
	            <div  class="ui-grid-a"  style="white-space: normal;">
			  	 @foreach ($files as $file)
			  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}"  data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
				 @endforeach
		  		</div>
	        </li>
	        <li class="ui-field-contain">
	            <label>投诉时间</label><p>{{ $complaint->create_at }}</p>
	        </li>
	         <li class="ui-field-contain">
	            <label>状态</label><p>{{ $complaint->state() }}</p>
	        </li>
        </li>
	    </ul>

	    <ul data-role="listview" data-inset="true">
	    	<li data-role="list-divider">事件列表</li>
	    	@foreach ($eventHistory as $event)
	    	<li>
	    	  <div class="ui-field-contain">
		      <label>{{$event->state->name}}</label>
		      <p>{{$event->commit_at}}</p>
		      </div>
			</li>
			@endforeach
		 </ul>
	     <a href="#" data-role="button" data-rel="back">返回</a>
	</div>
</div>
@stop