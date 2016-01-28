@extends('layouts.mobile')



@section('content')
<div data-role="page" class="doitem pgcommon">
  <div data-role="content">

  {{$accept_view}}

  {{ Form::open(array('url' => '', 'files'=>true,'data-ajax'=>'true')) }}
	 {{$event_deal}}
  {{ Form::close() }}

  {{$event_history}}


  @include('common.pop')
  <script type="text/javascript">
  $(function(){
	var page=$(".doitem").last();
	var form=page.find("form");
	page.find("#btn_save").click(function(){
		form.attr('action',"{{URL::to('wx/accept/doitem/'.$event->id.'/save')}}");
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
		form.attr('action',"{{URL::to('wx/accept/doitem/'.$event->id.'/commit')}}");
	});
  })
  </script>


  </div>
</div>
@stop
