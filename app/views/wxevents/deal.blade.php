@extends('layouts.mobile')

@section('content')
	<script>
	$(function(){
 			$("#btn_save").tap(function(){
				var url=$("form").attr('action');
				$("form").attr('action',url+'/save');
			});
			$("#btn_commit").tap(function(){
				if($("#next_id").length>0 && $("#next_id").val()==""){
					alert("请选下一步处理人");
					return false;
				}
				var url=$("form").attr('action');
				$("form").attr('action',url+'/commit');
			});
	});

   </script>

<div data-role="page">
  <div data-role="content">

	{{$accept_view}}

	{{ Form::open(array('url' => 'wx/events/deal/'.$event->id, 'files'=>true,'data-ajax'=>'false')) }}
	{{$event_deal}}
	{{ Form::close() }}

	{{$event_history}}

  </div>
</div>

@stop
