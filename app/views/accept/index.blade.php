@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉受理</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>编号</th>
			<th>姓名</th>
			<th>电话</th>
			<th>投诉内容</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($acceptSet as $accept)
		<tr>
			<td>{{ $accept->id }}</td>
			<td>{{ $accept->name }}</td>
			<td>{{ $accept->phone }}</td>
			<td>{{ $accept->content }}</td>
			<td>@if($accept->state_id){{ $accept->state->name }}@endif</td>

			<td>

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-default" href="{{ URL::to('accept/deal/'.$accept->id) }}">查看</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop