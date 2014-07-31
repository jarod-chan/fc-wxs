@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉受理状态</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
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
	</div>
	
	
	{{ Form::submit('保存', array('class' => 'btn btn-sm btn-primary')) }}
	 <a class="btn btn-sm btn-default" href="{{ URL::to('state/list' ) }}">返回</a>
{{ Form::close() }}	
 
 </div>
@stop