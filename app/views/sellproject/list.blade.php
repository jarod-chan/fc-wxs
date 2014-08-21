@extends('layouts.boot')



@section('content')
<div class="container">


<h1>小区管理</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>名称</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($sellProjectSet as $project)
		<tr>
			<td>{{ $project->fname_l2 }}</td>
			<td>{{ $project->state() }}</td>
			<td>
				@if($project->state=='on')
				<button class="btn_switch btn btn-default btn-warning" data-id="{{ $project->fid}}">关闭</button>
				@else
				<button class="btn_switch btn btn-default btn-primary" data-id="{{ $project->fid}}">开启</button>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

{{ Form::open(array('url' => 'sellproject/switchstate')) }}
 {{Form::hidden('id','',array('id'=>'project_id'))}}
{{ Form::close() }}

</div>
<<script type="text/javascript">
	$(function(){
		$(".btn_switch").click(function(){
			var form=$('form').last();
			form.find("#project_id").val($(this).data("id"));
			form.submit();
		})
	})
</script>
@stop