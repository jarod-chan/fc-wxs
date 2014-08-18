@extends('layouts.mobile')



@section('content')
<div data-role="page">
  <div data-role="content">


	<ul data-role="listview" data-inset="true">
	    <li data-role="list-divider">历史投诉</li>
	    @foreach($acceptSet as $accept)
		 <li>
		    <a href="{{ URL::to('wx/accept/history/item/'.$accept->id) }}">
		    <p style="white-space: normal;">{{ $accept->content }}</p>
		    <p>状态：@if( $accept->state_id){{ $accept->state->name }}@endif</p>
		    <p>创建时间:{{ $accept->create_at }}</p>
		    </a>
		</li>
		@endforeach
	</ul>


  </div>
</div>

@stop