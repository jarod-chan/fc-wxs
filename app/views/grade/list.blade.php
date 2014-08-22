@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉处理满意度</h1>

@include('common.alert')

<a class="btn btn-sm btn-primary  pull-right" href="{{ URL::to('grade/add') }}">新增</a>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>序号</th>
			<th>名称</th>
			<th>值</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($gradeSet as $grade)
		<tr>
			<td>{{ $grade->id }}</td>
			<td>{{ $grade->name }}</td>
			<td>{{ $grade->val }}</td>
			<td>{{ $grade->state() }}</td>
			<td>
			<a class="btn btn-sm btn-primary" href="{{ URL::to('grade/edit/'.$grade->id) }}">编辑</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop