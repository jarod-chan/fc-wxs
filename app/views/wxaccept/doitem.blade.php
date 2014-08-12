@extends('layouts.mobile')



@section('content')
<div data-role="page" id="doitem">
  <div data-role="content">

  	<script>
	$(document).on( "pagecreate", '#doitem', function() {
 			$("#btn_save").tap(function(){
				var url=$("form").attr('action');
				$("form").attr('action',url+'/save');
			});
			$("#btn_commit").tap(function(){
				var url=$("form").attr('action');
				$("form").attr('action',url+'/commit');
			});
			$(document).off('pagecreate', '#doitem');
	});
   </script>


  {{$accept_view}}

  {{ Form::open(array('url' => 'wx/accept/doitem/'.$event->id, 'files'=>true,'data-ajax'=>'false')) }}
	 {{$event_deal}}
  {{ Form::close() }}


  {{$event_history}}

  </div>
</div>
@stop
