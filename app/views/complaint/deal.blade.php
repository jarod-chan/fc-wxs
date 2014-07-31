@extends('layouts.boot')



@section('content')

<div class="container">

<h1>客户投诉-处理</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}


 <fieldset>
    <legend>客户投诉内容</legend>
    <div class='row'>
        <div class='col-sm-4'>    
            <div class='form-group'>
                <label >编号</label>
                <p class="form-control-static">{{$complaint->id}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >姓名</label>
                <p class="form-control-static">{{$complaint->name}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >联系号码</label>
                <p class="form-control-static">{{$complaint->phone}}</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label>投诉内容</label>
               <p class="form-control-static">{{$complaint->content}}</p>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-8'>
            <div class='form-group'>

                <label>地址</label>
               <p class="form-control-static">{{$complaint->address}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label>状态</label>
               <p class="form-control-static">{{$complaint->state()}}</p>
            </div>
        </div>
    </div>
    <div class="row">
	  <div class="col-sm-12">
	   <div class='form-group'>
            <label>附件</label>
            <div>
            @foreach ($files as $file)
            	<a href="{{ URL::asset('data/'.$file->filename) }}" data-toggle="lightbox" >
					<img src="{{ URL::asset('data/'.$file->filename) }}"   style="height: 180px;"  alt="{{$file->filename}}" class="img-thumbnail">
				</a>
			@endforeach
			</div>
       </div>
	  </div>
	</div>
</fieldset>


{{ Form::open(array('url' => 'complaint/deal/'.$complaint->id)) }}

<fieldset>
    <legend>投诉受理单</legend>
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
                <p class="form-control-static">{{$complaint->name}}</p>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='form-group'>
                <label >联系号码</label>
  				{{ Form::text('phone',$complaint->phone,array('class'=>'form-control')) }}
            </div>
        </div>
    </div>
    
    <div class='row'>
        <div class='col-sm-3'>    
            <div class='form-group'>
                <label >社区</label>
                {{ Form::select('community', $communityEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
        <div class='col-sm-3'>
            <div class='form-group'>
                <label >区域</label>
              	 {{ Form::select('area', $areaEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
        <div class='col-sm-2'>
            <div class='form-group'>
                <label >楼号</label>
  				 {{ Form::select('building', $buildingEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
          <div class='col-sm-2'>
            <div class='form-group'>
                <label >单元</label>
  				 {{ Form::select('unit', $unitEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
        <div class='col-sm-2'>
            <div class='form-group'>
                <label >房间</label>
  				{{ Form::text('room','0',array('class'=>'form-control')) }}
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label>投诉内容</label>
            	 <textarea class="form-control" name="content" rows="3">{{$complaint->content}}</textarea>
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
                <label >投诉类别</label>
                {{ Form::select('type', $typeEnums,'',array('class'=>'form-control'))}}
            </div>
        </div>
    </div> 
    <div class='row'>
    <div class='col-sm-12'>
    	<div class="checkbox">
        <label>
          <input type="checkbox" checked="true" disabled> 自动关联附件
        </label>
      </div>
      </div>
    </div> 
    
    

<p>

 <button id="btn_accept" class="btn btn-sm btn-primary" >生成受理单</button>
 <button id="btn_reject" class="btn btn-sm btn-warning" >拒绝</button>
 <a class="btn btn-sm btn-default" href="{{ URL::to('complaint/list' ) }}">返回</a>
</p>  
    
   
</fieldset>
{{ Form::close() }}	

<script type="text/javascript">
	$(function(){
		$("#btn_accept").click(function(){
			var url=$("form").attr('action');
			$("form").attr('action',url+'/accept');
			$("form").submit();
		})
		$("#btn_reject").click(function(){
			var url=$("form").attr('action');
			$("form").attr('action',url+'/reject');
			$("form").submit();
		})
	})
</script>


</div>
@stop