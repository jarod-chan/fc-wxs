@extends('layouts.main')

@section('content')
	<div>
	<img src="{{ URL::asset('plug/upfile/close.png') }}"/>
		<img style="width: 100%;" src="{{ URL::asset('data/'.$imgname) }}" />
	</div>
@stop