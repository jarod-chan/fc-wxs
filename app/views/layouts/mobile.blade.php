<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1" />
	{{HTML::style('css/jquery.mobile-1.4.3.min.css')}}
    {{HTML::script('js/jquery-1.11.1.min.js')}}
    {{HTML::script('js/jquery.mobile-1.4.3.min.js')}}
    <script type="text/javascript">
    var FYG_PATH="{{ URL::asset('') }}";
	 var V={
		require:function(jq,name){
			var msg='<p>'+name+'不能为空</p>';
			if(jq.length==0){
				return msg;
			}
			if($.trim(jq.val())==""){
				return msg;
			}
			return "";
		},
		req:function(jq,name){
			var msg='<p>'+name+'不能为空</p>';
			if(jq.length==0){
				return "";
			}
			if($.trim(jq.val())==""){
				return msg;
			}
			return "";
		}
	 };
    </script>

	@include('layouts.fileup_include')

	<style type="text/css">
 	.ui-listview > li p {
	    font-size: 1em;
	}
	</style>
</head>
<body>
		@yield('content')
</body>
</html>