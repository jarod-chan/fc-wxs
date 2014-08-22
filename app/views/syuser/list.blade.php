@extends('layouts.boot')



@section('content')
<div class="container">




<h1>系统用户</h1>

@include('common.alert')

<a class="btn btn-sm btn-primary  pull-right" href="{{ URL::to('syuser/add') }}">新增</a>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>用户名</th>
			<th>邮箱</th>
			<th>角色</th>
			<th>微信id</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($syuserSet as $syuser)
		<tr>
			<td>{{ $syuser->name }}</td>
			<td>{{ $syuser->email }}</td>
			<td>{{ $syuser->role() }}</td>
			<td>{{ $syuser->openid }}</td>

			<td>

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-sm btn-primary" href="{{ URL::to('syuser/edit/'.$syuser->id) }}">编辑</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop