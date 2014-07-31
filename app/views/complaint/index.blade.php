@extends('layouts.boot')



@section('content')
<div class="container">





<h1>客户投诉</h1>

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
	@foreach($complaintSet as $complaint)
		<tr>
			<td>{{ $complaint->id }}</td>
			<td>{{ $complaint->name }}</td>
			<td>{{ $complaint->phone }}</td>
			<td>{{ $complaint->content }}</td>
			<td>{{ $complaint->state() }}</td>

			<td>
				@if( $complaint->isDeal()) 
					<a class="btn  btn-sm btn-default" href="{{ URL::to('complaint/view/' . $complaint->id) }}">查看</a>
				@else
					<a class="btn btn-sm btn-primary"  href="{{ URL::to('complaint/deal/' . $complaint->id) }}">处理投诉</a>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop