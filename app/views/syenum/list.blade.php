@extends('layouts.boot')



@section('content')
<div class="container">





<h1>配置选项</h1>

@include('common.alert')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>名称</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($typeSet as $item)
		<tr>
			<td>{{$item['name']}}</td>
			<td>
				<a class="btn btn-sm btn-primary" href="{{ URL::to('syenum/vals/'.$item['val']) }}">编辑</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</div>
@stop