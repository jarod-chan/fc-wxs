@extends('layouts.boot')



@section('content')

<div class="container">

<h1>客户诉求-处理</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

<div class="text-right">
 <a class="btn btn-sm btn-default" href="{{ URL::to('complaint/list' ) }}">返回</a>
</div>

<div class="panel panel-default">
  <div class="panel-heading">客户诉求内容</div>
  <div class="panel-body">

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
                <label>客户房产</label>
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

</div>
</div>






</div>
@stop