@extends('layouts.mobile')

@section('content')
<div data-role="page">
  <div data-role="content">
  	
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户投诉内容</li>
        <li class="ui-field-contain">
            <label>编号</label><p>{{$accept->no}}</p>
        </li>
        <li class="ui-field-contain">
            <label>姓名</label><p>{{$accept->name}}</p>
        </li>
        <li class="ui-field-contain">
        <label>联系号码</label>
  		<p>{{$accept->phone}}</p>
  		</li>
  		<li class="ui-field-contain">
  		<label>投诉内容</label>
  		<p>{{$accept->content}}</p>
        </li>
        <li class="ui-field-contain">
        	<label>附件</label>
	  		<div  class="ui-grid-a ui-responsive" >
	  			 @foreach ($files as $file)
					<img src="{{ URL::asset('data/'.$file->filename) }}"   style="height: 180px;"  alt="{{$file->filename}}">
				@endforeach
	  		</div>
        </li>
    </ul>
  
{{ Form::open(array('url' => 'events/deal/'.$event->id, 'files'=>true)) }}
    <ul data-role="listview" data-inset="true">
        <li class="ui-field-contain">
            <label for="type">任务节点</label>
              {{ Form::select('type',$typeSet)}}
        </li>
        <li class="ui-field-contain">
            <label for="result">结果记录</label>
       		 <textarea cols="40" rows="8" name="result" id="result"></textarea>
        </li>
        <li class="ui-field-contain">
            <label for="file[]">附件</label>
			{{Form::file('file[]', array('multiple'=>true))}}
        </li>
        <li class="ui-field-contain">
        	<label for="next">下一步处理人</label>
        	{{ Form::select('next',$personSet)}}
        </li>
        <li class="ui-grid-a ui-responsive">
		    <div class="ui-block-a"><a href="#" class="ui-btn  ui-shadow  ui-corner-all" >暂存</a></div>
		    <div class="ui-block-b"><button type="submit" class="ui-btn  ui-shadow  ui-corner-all" >提交</button></div>
		</li>  
    </ul>
{{ Form::close() }}	

  <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">事件列表</li>
    	@foreach ($eventHistory as $event)
    	<li class="ui-field-contain">
		      <label>{{$event->type()}}</label><p>{{$event->result}}</p>
		</li>
		@endforeach
 </ul>
  
  	
  </div>
</div> 

@stop
