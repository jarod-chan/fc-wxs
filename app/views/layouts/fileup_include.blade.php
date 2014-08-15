
{{HTML::style('plug/upfile/def.css')}}
{{HTML::script('plug/upfile/binaryajax.js')}}
{{HTML::script('plug/upfile/exif.js')}}
{{HTML::script('plug/upfile/megapix-image.js')}}
{{HTML::script('plug/upfile/jquery.make-thumb.js')}}

<script type="text/javascript">
function initFile(plug_fileup){
	var file_len=0;
	var file = plug_fileup.find(".fileinput");
	var img_div=plug_fileup.find(".up_file_div");
	return function (){
		var index=file_len;
		file.makeThumb({
			width: 800,
			height: 600,
			success: function(dataURL, tSize, file, sSize, fEvt) {
				if(index!=file_len) return;

				var myDate = new Date();
				var random = parseInt(10*Math.random())
				var Minute = myDate.getMinutes();	//获取当前分钟
				var Second = myDate.getSeconds();	//获取当前秒数

				var id = Minute+''+Second+''+random;

				var html = '<div class="img_ck" id="'+id+'"><img class="up_img" src="'+dataURL+'"/><span class="close_span"  onclick="remove_del('+id+')"><img src="{{ URL::asset('plug/upfile/close.png') }}"/></span><input type="hidden" name="file[]" value="'+dataURL+'" /></div>';
				img_div.append(html);
				file_len=file_len+1;
			}
		});
	}
}
function remove_del(id){
	if(id){
		if(confirm('您确定要删除吗?')){
			$("#"+id).remove();
		}
	}
}
function remove_saved(id){
	var plug_fileup=$('.plug-fileup').last();
	var delete_file=plug_fileup.find(".delete_file_id");
	delete_file.val(delete_file.val()+"|"+id);
	$("#saved_"+id).remove();
}
</script>
