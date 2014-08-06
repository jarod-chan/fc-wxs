@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉受理状态</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 <div class='row'>
        <div class='col-sm-12'>    
 			<a class="btn btn-sm btn-primary  pull-right" id="btn_add">新增</a>
        </div>
</div>

{{ Form::open(array('url' => 'state/'.$id.'/userinfo')) }} 
<table id="tab_main" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="hide">id</th>
			<th>用户</th>
			<th>属性</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($stateUserSet as $stateUser)
		<tr>
			<td class="hide">{{ Form::hidden('stateUser[-][id]',$stateUser->id)}}</td>
			<td>{{ Form::select('stateUser[-][user_id]',$syUserSet,$stateUser->user_id,array('class'=>'form-control'))}}</td>
			<td>{{ Form::select('stateUser[-][tag_key]',$tagSet,$stateUser->tag_key,array('class'=>'form-control'))}}</td>
			<td><button class="btn btn-sm  btn-warning btn_delete" >删除</button></td>
		</tr>
	@endforeach
	</tbody>
</table>


	<button class='btn btn-sm btn-primary' id='btn_save'>保存</button>
	<a class="btn btn-sm btn-default" href="{{ URL::to('state/list' ) }}">返回</a>
{{ Form::close() }}	

<script type="text/javascript">
	$(function(){
		
		var tr=$("<tr>");
		$('<td class="hide"></td>').append($('{{ Form::hidden("stateUser[-][id]","")}}')).appendTo(tr);
		$("<td>").append($('{{ Form::select("stateUser[-][user_id]",$syUserSet,'',array("class"=>"form-control"))}}')).appendTo(tr);
		$("<td>").append($('{{ Form::select("stateUser[-][tag_key]",$tagSet,'',array("class"=>"form-control"))}}')).appendTo(tr);
		$("<td>").append($('<button class="btn btn-sm  btn-warning btn_delete" >删除</button>')).appendTo(tr);
		function copytr(){
			var row=tr.clone();
			row.find(".btn_delete").click(deleteRow);
			return row;
		}

		function deleteRow(){
			var row=$(this).parents("tr:eq(0)");
			row.remove();
		}

		$(".btn_delete").click(deleteRow);
		$("#btn_add").click(function(){
			var tab=$("#tab_main tbody");
			tab.append(copytr());
		});
		$("#btn_save").click(function(){
			$("#tab_main tbody").formatName();
			$("form").eq(0).submit();
		})
	})
</script>

</div>
@stop