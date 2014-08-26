<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/bootstrap-theme.min.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/myplug.js')}}

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
       @if (!Auth::guest())
         	 <ul class="nav navbar-nav">
	              <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">投诉处理 <span class="caret"></span></a>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="{{ URL::to('complaint/list') }}">客户投诉</a></li>
	                <li><a href="{{ URL::to('accept/list') }}">投诉受理</a></li>
	              </ul>
	            </li>

             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">系统配置 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('syuser/list') }}">系统用户</a></li>
                <li><a href="{{ URL::to('sytag/list') }}">系统标签</a></li>
                <li><a href="{{ URL::to('state/list') }}">投诉受理状态</a></li>
                <li><a href="{{ URL::to('grade/list') }}">投诉处理满意度</a></li>
                <li><a href="{{ URL::to('registeruser/list') }}">注册用户</a></li>
                <li><a href="{{ URL::to('sellproject/list') }}">小区管理</a></li>
                <li><a href="{{ URL::to('syenum/list') }}">投诉受理配置选项</a></li>
              </ul>
            </li>

		 </ul>
		@endif

          @if ( Auth::guest() )
          <div  class="navbar-collapse collapse navbar-right">
          {{ HTML::link('/login', '登录',array('class'=>'btn btn-sm btn-default navbar-btn')) }}
          </div>
          @else
          <div  class="navbar-collapse collapse navbar-right">
          <button id="btn_logout" class="btn btn-sm btn-default navbar-btn">退出</button>
         </div>
		  <p class="navbar-text navbar-right">用户：{{Auth::user()->name}}&nbsp;&nbsp;</p>
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
