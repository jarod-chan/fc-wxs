@extends('layouts.boot')



@section('content')

<div class="container">

<h1>诉求受理-处理</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}


 <fieldset>
    <legend>诉求受理内容</legend>
    <div class='row'>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >编号</label>
                <p class="form-control-static">{{$accept->id}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >姓名</label>
                <p class="form-control-static">{{$accept->name}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >联系号码</label>
                <p class="form-control-static">{{$accept->phone}}</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>

                <label>投诉内容</label>
               <p class="form-control-static">{{$accept->content}}</p>
            </div>
        </div>
    </div>
        <div class='row'>
        <div class='col-sm-8'>
            <div class='form-group'>

                <label>客户房产</label>
               <p class="form-control-static">@if($accept->room_id){{$accept->room->address()}}@endif</p>
            </div>
        </div>
          <div class='col-sm-4'>
            <div class='form-group'>
                <label>状态</label>
               <p class="form-control-static">@if($accept->state_id){{ $accept->state->name }}@endif</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >信息来源</label>
                 <p class="form-control-static">{{$accept->from()->name }}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >严重程度</label>
				 <p class="form-control-static">{{$accept->degree()->name }}</p>
            </div>
        </div>
         <div class='col-sm-4'>
            <div class='form-group'>
                <label >诉求类别</label>
                 <p class="form-control-static">{{$accept->type()->name }}</p>
            </div>
        </div>
    </div>
    <div class="row">
	  <div class="col-sm-12">
	   <div class='form-group'>
            <label>附件</label>
           <div>
            @foreach ($accept->files as $file)
            	<a href="{{ URL::asset('data/'.$file->filename) }}" data-toggle="lightbox" >
					<img src="{{ URL::asset('data/'.$file->filename) }}"   style="height: 180px;"  alt="{{$file->filename}}" class="img-thumbnail">
				</a>
			@endforeach
			</div>
       </div>
	  </div>
	</div>
 </fieldset>

 <div class="panel panel-default">
  <div class="panel-heading">处理流程</div>

  <ul class="list-group">
    @foreach ($eventHistory as $event)
      <li class="list-group-item">
      <div class="row">
	     @if ($event->isCommited())
	     <div class="col-sm-2">
	     	<p>{{$event->state->name}}</p>
	     </div>
	     <div class="col-sm-6"><p>{{ $event->result}}</p></div>
	     @else
	     <div class="col-sm-2">
	     	<p>{{$event->state->name}}</p>
	     </div>
	      <div class="col-sm-6 ">
				<div class="input-group">
				  <input type="text" class="form-control" value="{{ URL::to('wx/events/deal/'.$event->id) }}"  readonly="readonly">
				  <span class="input-group-btn">
				    <a class="btn  btn-success bt_copy"  data-url="{{ URL::to('wx/events/deal/'.$event->id) }}" >复制</a>
				  </span>
				</div>
	      </div>
		 @endif

	     <div class="col-sm-4">
	     	<p>处理人：{{ $event->deal->name}}</p>
	     	<p>创建时间：{{ $event->create_at}}</p>
	     </div>
	  </div>
	  </li>
      @endforeach
  </ul>
</div>

<p>
 <a class="btn btn-sm btn-default" href="{{ URL::to('accept/list' ) }}">返回</a>
</p>



</div>

{{HTML::script('plug/zclip/jquery.zclip.min.js')}}
<script type="text/javascript">
	$('.bt_copy').zclip({
	    path: "{{ URL::asset('plug/zclip/ZeroClipboard.swf') }}",
	    copy: function(){
				return $(this).data("url");
			},
	    afterCopy:function(){
		}
	});
</script>


@stop