
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户投诉内容</li>
        <li  class="ui-field-contain">
            <label>编号</label><p>{{$accept->no}}</p>
        	<div  class="ui-grid-a"  style="white-space: normal;">
			 @foreach ($acceptFiles as $file)
		  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}" data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
			 @endforeach
	  		</div>
        </li>
        <li class="ui-field-contain">
            <label>姓名</label><p>{{$accept->name}}</p>
        </li>
        <li class="ui-field-contain">
        <label>联系号码</label>
  		<p>{{$accept->phone}}</p>
  		</li>
  		<li class="ui-field-contain">
  		<label>投诉内容</label>
  		<p>{{$accept->content}}</p>
        </li>
    </ul>