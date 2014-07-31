@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	
	<ul data-role="listview" data-inset="true">
	    <li data-role="list-divider">我的投诉清单</li>
	    @foreach($complaintSet as $complaint)
		 <li>
		    <a href="{{ URL::to('complaint/'. $complaint->id) }}">
		    <p style="white-space: normal;">{{ $complaint->content }}</p>
		    <p>投诉时间：{{ $complaint->create_at }}</p>
		    <p class="ui-li-cside">状态：<strong>{{ $complaint->state() }}</strong></p>
		    </a>
		</li>
		@endforeach
	</ul>
	
	
  </div>
</div>
	
@stop