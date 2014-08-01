@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">
	
	
	<ul data-role="listview" data-inset="true">
	    <li data-role="list-divider">历史投诉</li>
	    @foreach($acceptSet as $accept)
		 <li>
		    <a href="{{ URL::to('accept/history/item/'.$accept->id) }}">
		    <p style="white-space: normal;">{{ $accept->content }}</p>
		    <p class="ui-li-cside">状态：<strong>@if( $accept->state_id){{ $accept->state->name }}@endif</strong></p>
		    </a>
		</li>
		@endforeach
	</ul>
	
	
  </div>
</div>
	
@stop