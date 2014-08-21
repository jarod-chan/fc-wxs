@extends('layouts.boot')



@section('content')

<div class="container">

<h1>客户投诉-处理</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}


 <fieldset>
    <legend>客户投诉内容</legend>
    <div class='row'>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >编号</label>
                <p class="form-control-static">{{$complaint->id}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >姓名</label>
                <p class="form-control-static">{{$complaint->name}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >联系号码</label>
                <p class="form-control-static">{{$complaint->phone}}</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label>投诉内容</label>
               <p class="form-control-static">{{$complaint->content}}</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-8'>
            <div class='form-group'>
                <label>投诉房产</label>
                @if($complaint->room_id)
                <p class="form-control-static">{{$complaint->room->address()}}</p>
            	@endif
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label>状态</label>
               <p class="form-control-static">{{$complaint->state()}}</p>
            </div>
        </div>
    </div>
    <div class="row">
	  <div class="col-sm-12">
	   <div class='form-group'>
            <label>附件</label>
            <div>
            @foreach ($complaint->files as $file)
            	<a href="{{ URL::asset('data/'.$file->filename) }}" data-toggle="lightbox" >
					<img src="{{ URL::asset('data/'.$file->filename) }}"   style="height: 180px;"  alt="{{$file->filename}}" class="img-thumbnail">
				</a>
			@endforeach
			</div>
       </div>
	  </div>
	</div>
</fieldset>

<p>
 <a class="btn btn-sm btn-default" href="{{ URL::to('complaint/list' ) }}">返回</a>
</p>





</div>
@stop