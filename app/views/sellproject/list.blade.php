@extends('layouts.boot')



@section('content')
<div class="container">


<h1>小区管理</h1>

@include('common.alert')

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
			<td><span class="label @if($project->state=='on') label-success @else label-default @endif">{{ $project->state() }}</span></td>
			<td>

				<button class="btn_switch btn btn-sm btn-primary" data-id="{{ $project->fid}}">
				@if($project->state=='on')关闭 @else 开启 @endif
				</button>


			</td>
		</tr>
	@endforeach
	</tbody>
</table>

{{ Form::open(array('url' => 'sellproject/switchstate')) }}
{{ Form::hidden('id','',array('id'=>'project_id')) }}
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