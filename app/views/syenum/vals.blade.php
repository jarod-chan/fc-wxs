@extends('layouts.boot')



@section('content')
<div class="container">





<h1>投诉受理配置选项</h1>

@include('common.alert')

{{ Form::open(array('url' => 'syenum/vals/'.$type)) }}

<div class='row'>
        <div class='col-sm-12'>
 			<a class="btn btn-sm btn-primary  pull-right" id="btn_add">新增</a>
        </div>
</div>

<table id="tab_main" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>关键字</th>
			<th>名称</th>
			<th>排序</th>
		</tr>
	</thead>
	<tbody>
		@foreach($syenumSet as $syenum)
		<tr>
			<td>
				{{ Form::text("syenum[-][key]",$syenum->key,array("class"=>"form-control"))}}
			</td>
			<td>
				{{ Form::text("syenum[-][name]",$syenum->name,array("class"=>"form-control"))}}
			</td>
			<td>
				{{ Form::text("syenum[-][sq]",$syenum->sq,array("class"=>"form-control"))}}
			</td>
			<td>
				<button class="btn btn-sm  btn-warning btn_delete" >删除</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

	<button class='btn btn-sm btn-primary' id='btn_save'>保存</button>
	<a class="btn btn-sm btn-default" href="{{ URL::to('syenum/list' ) }}">返回</a>
{{ Form::close() }}

<script type="text/javascript">
	$(function(){

		var tr=$("<tr>");
		$("<td>").append($('{{ Form::text("syenum[-][key]","",array("class"=>"form-control"))}}')).appendTo(tr);
		$("<td>").append($('{{ Form::text("syenum[-][name]","",array("class"=>"form-control"))}}')).appendTo(tr);
		$("<td>").append($('{{ Form::text("syenum[-][sq]","",array("class"=>"form-control"))}}')).appendTo(tr);
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
			$("form").last().submit();
		})
	})
</script>

</div>
@stop