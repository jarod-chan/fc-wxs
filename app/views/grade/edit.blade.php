@extends('layouts.boot')



@section('content')
<div class="container">





<h1>诉求处理满意度</h1>

@include('common.alert')

{{ Form::open(array('url' => 'grade/save')) }}

  	{{ Form::hidden('id',$grade->id) }}
	 <div class='row'>
	 		<div class='col-sm-6'>
	            <div class='form-group'>
	                <label >序号</label>
					<p class="form-control-static">{{$grade->id}}</p>
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >名称</label>
	                {{ Form::text('name',$grade->name,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >值</label>
	                 {{ Form::text('val',$grade->val,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >状态</label>
	                {{ Form::select('state',$stateEnums,$grade->state,array('class'=>'form-control'))}}
	            </div>
	        </div>
	</div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('grade/list' ) }}">返回</a>
{{ Form::close() }}

 </div>
@stop