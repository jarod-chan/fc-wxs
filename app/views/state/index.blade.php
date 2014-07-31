@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉受理状态</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<a class="btn btn-sm btn-primary  pull-right" href="{{ URL::to('state/add') }}">新增</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>序号</th>
			<th>名称</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($stateSet as $state)
		<tr>
			<td>{{ $state->no }}</td>
			<td>{{ $state->name }}</td>

			<td>

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-primary" href="{{ URL::to('state/edit/'.$state->id) }}">编辑</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop