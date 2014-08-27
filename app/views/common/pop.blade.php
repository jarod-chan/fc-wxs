<!-- jqm 弹出信息框 -->
<div data-role="popup" class="cl_popup" data-overlay-theme="b"  data-dismissible="false" style="min-width:250px;max-width: 400px;" >
<div data-role="header" data-theme="a">
<h1>系统信息</h1>
</div>
<div role="main" class="ui-content">
<a data-rel="back" class="ui-btn ui-shadow ui-corner-all">确定</a>
</div>
</div>
<script type="text/javascript">
var pop=$(".cl_popup").last();
pop.open=function(msg){
	var obj=$(this);
	obj.find(".ui-content>p").remove();
	obj.find(".ui-content").prepend(msg);
	obj.popup("open");
}
</script>