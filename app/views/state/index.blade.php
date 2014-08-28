@extends('layouts.boot')



@section('content')
<div class="container">





<h1>诉求受理状态</h1>

@include('common.alert')

<a class="btn btn-sm btn-primary  pull-right" href="{{ URL::to('state/add') }}">新增</a>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>序号</th>
			<th>名称</th>
			<th>属性</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($stateSet as $state)
		<tr>
			<td>{{ $state->no }}</td>
			<td>{{ $state->name }}</td>
			<td>{{ $state->prop }}</td>
			<td>

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-sm btn-primary" href="{{ URL::to('state/edit/'.$state->id) }}">编辑</a>
				<a class="btn btn-sm btn-primary" href="{{ URL::to('state/'.$state->id.'/userinfo') }}">人员配置</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop