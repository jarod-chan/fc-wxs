@extends('layouts.boot')



@section('content')
<div class="container">





<h1>系统标签</h1>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>标签</th>
			<th>名称</th>
		</tr>
	</thead>
	<tbody>
	@foreach($syTagSet as $sytag)
		<tr>
			<td>{{ $sytag->key }}</td>
			<td>{{ $sytag->name }}</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop