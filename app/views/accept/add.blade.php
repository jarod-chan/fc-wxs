@extends('layouts.boot')

@section('import_head')
    @include('layouts.fileup_include')
     <script type="text/javascript">
    var FYG_PATH="{{ URL::asset('') }}";
    </script>
@stop

@section('content')
<div class="container">

<h1>诉求受理-新增</h1>


{{ Form::open(array('url' => 'accept/add')) }}


    <div class='row'>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >编号</label>
                <p class="form-control-static">系统自动生成</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >姓名</label>
               {{ Form::text('name','',array('class'=>'form-control')) }}
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >联系号码</label>
  				{{ Form::text('phone','',array('class'=>'form-control')) }}
            </div>
        </div>
    </div>
    <div class='row' id="row_sel">
        <div class='col-sm-3'>
            <div class='form-group'>
                <label >小区</label>
                {{ Form::select('',H::prepend($sellProjectSet,'--请选择--'),'',array('class'=>'form-control','id'=>'sel_sellproject'))}}
            </div>
        </div>
        <div class='col-sm-3'>
            <div class='form-group'>
                <label >楼栋</label>
              	 {{ Form::select('', array(''=>''),'',array('class'=>'form-control','disabled'=>'true','id'=>'sel_building'))}}
            </div>
        </div>
        <div class='col-sm-3'>
            <div class='form-group'>
                <label >单元</label>
  				 {{ Form::select('', array(''=>''),'',array('class'=>'form-control','disabled'=>'true','id'=>'sel_buildingunit'))}}
            </div>
        </div>
          <div class='col-sm-3'>
            <div class='form-group'>
                <label >房间</label>
  				 {{ Form::select('room_id', array(''=>''),'',array('class'=>'form-control','disabled'=>'true','id'=>'sel_room'))}}
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label>投诉内容</label>
            	 <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >信息来源</label>
                {{ Form::select('from', $fromEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >严重程度</label>
                {{ Form::select('degree', $degreeEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
         <div class='col-sm-4'>
            <div class='form-group'>
                <label >诉求类别</label>
                {{ Form::select('type', $typeEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
    </div>
    <div class='row'>
    <div class='col-sm-4'>
    	<div class='form-group'>
               <label >下一步流程</label>
               <p class="form-control-static">{{$stateBeg->name}}</p>
                {{ Form::hidden('next_state_id',$stateBeg->id)}}
        </div>
    </div>

     <div class='col-sm-4'>
    	<div class='form-group'>
               <label >流程标签</label>
              {{ Form::select('tag_key',$tagSet,'',array('class'=>'form-control','id'=>'tag_key'))}}
        </div>
    </div>

    <div class='col-sm-4'>
    	<div class='form-group'>
               <label >下一步处理人</label>
              {{ Form::select('next_id',array(),'',array('class'=>'form-control','id'=>'next_id'))}}
        </div>
    </div>

    </div>

    <div class="row" style="margin-bottom: 15px;">
     <div class='col-sm-12'>
    <div class='form-group'>
    	<label >附件</label>
   		<div class="plug-fileup">
				<div class="up_file_div"></div>
				<div class="add_img_div"><input class="fileinput" type="file" ></div>
		</div>
		<script type="text/javascript">
			var plug_fileup=$('.plug-fileup').last();
			var fileup=initFile(plug_fileup);
			plug_fileup.find(".fileinput").click(fileup);
		</script>
    </div>
     </div>
	</div>



<p>
 <button id="btn_commit" class="btn btn-sm btn-primary" >生成受理单</button>
 <a class="btn btn-sm btn-default" href="{{ URL::to('accept/list' ) }}">返回</a>
</p>


{{ Form::close() }}

<script type="text/javascript">
	$(function(){

		function getSelfunc(index,queryTag){
			return function(){
				$("#row_sel select:gt("+index+")").empty().attr("disabled",true).append($("<option value=''>--请选择--</option>"));
				if($(this).val()=="") return;
				$.get('{{URL::to("selroom/sel")}}',{'val':$(this).val(),'tag':queryTag},function(data){
					var toSelect=$("#row_sel select:eq("+(index+1)+")");
					for(var i=0;i<data.length;i++){
						toSelect.append($("<option value='"+data[i].id+"'>"+data[i].name+"</option>"));
					}
					toSelect.removeAttr("disabled");
				});
			}
		}

		$("#sel_sellproject").change(getSelfunc(0,'building'));
		$("#sel_building").change(function(){
			$("#row_sel select:gt(1)").empty().attr("disabled",true).append($("<option value=''>--请选择--</option>"));
			if($(this).val()=="") return;
			$.get('{{URL::to("selroom/sel_buildingunit")}}',{'val':$(this).val()},function(data){
				if(data.type=="unit"){
					var toSelect=$("#sel_buildingunit");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.removeAttr("disabled");
				}else if(data.type=="room"){
					var toSelect=$("#sel_room");
					for(var i=0;i<data.arr.length;i++){
						toSelect.append($("<option value='"+data.arr[i].id+"'>"+data.arr[i].name+"</option>"));
					}
					toSelect.removeAttr("disabled");
				}
			});
		});
		$("#sel_buildingunit").change(getSelfunc(2,'room'));

		$("#btn_commit").click(function(){
			if($("#sel_room").val()==""){
				alert("请先选择房间");
				return false;
			}
			$("form").submit();
		})


		var nextSet={{$stateBeg->stateUser->toJson()}};
		$("#tag_key").change(function(){
			$("#next_id option").remove();
			var tag=$(this).val()
			$.each(nextSet,function(n,obj){
				if(obj.tag_key==tag){
					$("#next_id").append("<option value='"+obj.user_id+"'>"+obj.user_name+"</option>");
				}
			});
		});
		$("#tag_key").triggerHandler('change');
	})
</script>

</div>
@stop