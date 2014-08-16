@extends('layouts.boot')



@section('content')
<div class="container">
<h1>注册用户</h1>

<div class="row">
  <div class="col-sm-6">
  	<div class='form-group'>
    <label class="control-label">openid</label>
     <p class="form-control-static">{{$wxuser->openid}}&nbsp;</p>
     </div>
  </div>
 <div class="col-sm-6">
 	<div class='form-group'>
    <label class="control-label">姓名</label>
    <p class="form-control-static">{{$wxuser->name}}&nbsp;</p>
    </div>
  </div>
  <div class="col-sm-6">
   <div class='form-group'>
    <label class="control-label">联系号码</label>
    <p class="form-control-static">{{$wxuser->phone}}&nbsp;</p>
  	</div>
  </div>
  <div class="col-sm-6">
  <div class='form-group'>
    <label class="control-label">邮箱</label>
    <p class="form-control-static">{{$wxuser->email}}&nbsp;</p>
    </div>
  </div>
  <div class="col-sm-6">
  <div class='form-group'>
    <label class="control-label">用户类型</label>
    <p class="form-control-static">{{$wxuser->getTypeVal()}}&nbsp;</p>
    </div>
  </div>
   <div class="col-sm-6">
   <div class='form-group'>
    <label class="control-label">身份证</label>
    <p class="form-control-static">{{$wxuser->idcard}}&nbsp;</p>
    </div>
  </div>
   <div class="col-sm-6">
   <div class='form-group'>
    <label class="control-label">职业</label>
    <p class="form-control-static">{{$wxuser->profession}}&nbsp;</p>
    </div>
  </div>
   <div class="col-sm-6">
   <div class='form-group'>
    <label class="control-label">兴趣爱好</label>
    <p class="form-control-static">{{$wxuser->interest}}&nbsp;</p>
    </div>
  </div>
   <div class="col-sm-6">
   <div class='form-group'>
    <label class="control-label">地址</label>
    <p class="form-control-static">{{$wxuser->address}}&nbsp;</p>
    </div>
  </div>
</div>

 <a class="btn btn-default" href="{{ URL::to('registeruser/list' ) }}">返回</a>

</div>
@stop