@extends('layouts.mobile')

@section('content')

<div data-role="page" class='event_deal pgcommon'>
  <div data-role="content">

	{{$accept_view}}

	{{ Form::open(array('url' => '','data-ajax'=>'true')) }}
	{{$event_deal}}
	{{ Form::close() }}

	{{$event_history}}

	@include('common.pop')
  	<script type="text/javascript">
	  $(function(){
		var page=$(".event_deal").last();
		var form=page.find("form");

		$(document).on('pagehide', '.event_deal', function(event, ui) {
		    $(event.target).remove();
		});
		$(document).on('pagecreate', '.event_deal', function() {
			var page=$(".event_deal").last();
// 			var toSelect=page.find("#next_id");
// 			toSelect.selectmenu();
// 			toSelect.selectmenu('refresh', true);

		});



		page.find("#btn_save").click(function(){
			form.attr('action',"{{URL::to('wx/events/deal/'.$event->id.'/save')}}");
		});

		page.find("#btn_commit").click(function(){
			var msg="";
			msg+=V.require(page.find('#result'),'结果记录');

			msg+=V.req(page.find('#tag_key'),'流程标签');//如果存在则校验
			msg+=V.req(page.find('#next_id'),'下一步处理人');//如果存在则校验
			if(page.find('input[type="radio"][name="grade_id"]').length>0){
				msg+=V.require(page.find('input[type="radio"][name="grade_id"]:checked'),'投诉处理满意度');
			}

			if(msg!==""){
				pop.open(msg);
				return false;
			}
			form.attr('action',"{{URL::to('wx/events/deal/'.$event->id.'/commit')}}");
		});
	  })


	  </script>

  </div>
</div>

@stop
