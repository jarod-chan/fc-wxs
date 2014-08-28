@extends('layouts.boot')



@section('content')
<div class="container">





<h1>诉求受理状态</h1>

@include('common.alert')

{{ Form::open(array('url' => 'state/save')) }}
	 {{Form::hidden('id',$state->id)}}
	 <div class='row'>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >编号</label>
	                {{ Form::text('no',$state->no,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >名称</label>
	                 {{ Form::text('name',$state->name,array('class'=>'form-control')) }}
	            </div>
	        </div>
	        <div class='col-sm-6'>
	            <div class='form-group'>
	                <label >属性</label>
	                 {{ Form::text('prop',$state->prop,array('class'=>'form-control')) }}
	            </div>
	        </div>
	</div>


	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('state/list' ) }}">返回</a>
{{ Form::close() }}

 </div>
@stop