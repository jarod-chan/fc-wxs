@extends('layouts.boot')



@section('content')
<div class="container">


<h1>注册用户</h1>

@include('common.alert')

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>openid</th>
			<th>姓名</th>
			<th>联系号码</th>
			<th>邮箱</th>
			<th>用户类型</th>
			<th>身份证</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($wxuserSet as $wxuser)
		<tr>
			<td>{{ $wxuser->openid }}</td>
			<td>{{ $wxuser->name }}</td>
			<td>{{ $wxuser->phone }}</td>
			<td>{{ $wxuser->email }}</td>
			<td>{{ $wxuser->getTypeVal() }}</td>
			<td>{{ $wxuser->idcard }}</td>
			<td>
				<a class="btn btn-sm btn-default" href="{{ URL::to('registeruser/view/'.$wxuser->openid) }}">查看</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@stop