@extends('layouts.main')

@section('content')
	<div>
		<img style="width: 100%;" src="{{ URL::asset('data/'.$imgname) }}" />
	</div>
@stop