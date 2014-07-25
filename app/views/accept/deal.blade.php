@extends('layouts.boot')



@section('content')

<div class="container">

<h1>投诉受理-处理</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}


 <fieldset>
    <legend>投诉受理内容</legend>
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
        <div class='col-sm-12'>
            <div class='form-group'>

                <label>地址</label>
               <p class="form-control-static">{{$accept->getAddress()}}</p>
            </div>
        </div>
    </div>
    <div class="row">
	  <div class="col-sm-12">
	   <div class='form-group'>
            <label>附件</label>
            <div>
            @foreach ($files as $file)
				<img src="{{ URL::asset('data/'.$file->filename) }}"   style="height: 180px;"  alt="{{$file->filename}}" class="img-thumbnail">
			@endforeach
			</div>
       </div>
	  </div>
	</div>
 </fieldset>
 
 {{ Form::open(array('url' => 'accept/deal/'.$accept->id)) }}
 <fieldset>
    <legend>下一步处理人</legend>
    <div class="form-horizontal">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">下一步处理人</label>
	    <div class="col-sm-4">
	        {{ Form::select('deal',$personSet,'',array('class'=>'form-control'))}}
	    </div>
	    <div class="col-sm-6">
	         <button type="submit" class="btn btn-sm btn-primary">生成任务</button>
	    </div>
	 </div>
	</div>
</fieldset> 
{{ Form::close() }}	

<p>
 <a class="btn btn-sm btn-default" href="{{ URL::to('accept/list' ) }}">返回</a>
</p>  
    
   



</div>
@stop