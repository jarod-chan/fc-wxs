<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    
    <!-- Bootstrap -->
    {{HTML::style('css/bootstrap.min.css')}} 
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    
    {{HTML::style('plug/lightbox/ekko-lightbox.min.css')}} 
    {{HTML::script('plug/lightbox/ekko-lightbox.min.js')}} 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">客户投诉系统</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">投诉处理 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('complaint/list') }}">客户投诉</a></li>
                <li><a href="{{ URL::to('accept/list') }}">投诉受理</a></li>
              </ul>
            </li>
            
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">基础信息 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('syuser/list') }}">系统用户</a></li>
                <li><a href="{{ URL::to('state/list') }}">投诉受理状态</a></li>
              </ul>
            </li>
            
            
<!--             <li class="active"><a href="#">客户投诉</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
             
            
          </ul>
          @if ( Auth::guest() )
          <ul class="nav navbar-nav navbar-right">
        	<li>{{ HTML::link('/login', '登录') }}</li>
          </ul>
          @else
          <ul class="nav navbar-nav navbar-right">
        	<li><a id="btn_logout"  href="#">退出</a></li>
          </ul>
		  <p class="navbar-text navbar-right">用户：{{Auth::user()->name}}</p>
		  @endif
        </div><!--/.nav-collapse -->
      </div>
    </div>
  
  
  
  		@yield('content')
  		
  		 
  		  <script type="text/javascript">
            $(document).ready(function ($) {
				$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox();
				});
			});

            $(function () {
                $("#btn_logout").click(function(){ 
                	$('<form/>',{action:"{{ URL::to('logout') }}",method:'post'})
           			.appendTo($("body"))
           			.submit();
                })
            })
        </script>
  </body>
</html>
