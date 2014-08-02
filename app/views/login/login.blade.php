@extends('layouts.boot')

@section('content')
<div class="container" style="margin-top:30px">
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><strong>用户登录 </strong></h3></div>
  <div class="panel-body">
	{{ Form::open(array('url' => 'login')) }}
	  <div class="form-group">
	    <label for="name">用户名</label>
	    <input name="name"  class="form-control" placeholder="输入用户名">
	  </div>
	  <div class="form-group">
	    <label for="password">密码</label>
	    <input name="password" id="password"  type="password" class="form-control"  placeholder="******">
	  </div>
	  @if (Session::has('login_errors'))
	  <div class="alert alert-danger" role="alert">
	    	<a class="close" data-dismiss="alert" href="#">×</a>用户名或密码错误!
	   </div>
	  @endif
	  <button type="submit" class="btn btn-sm btn-primary">登录</button>
	</form>
  </div>
</div>
</div>
</div>


@stop
