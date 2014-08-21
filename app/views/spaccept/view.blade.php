
    <ul data-role="listview" data-inset="true">
    	<li data-role="list-divider">客户信息</li>
		<li  class="ui-field-contain">
			<p>姓名:{{$accept->name}}</p>
		</li>
		<li  class="ui-field-contain">
			<p>联系号码:{{$accept->phone}}</p>
		</li>
		<li  class="ui-field-contain">
			<p>房产:@if($accept->room_id){{$accept->room->address()}}@endif</p>
		</li>
    	<li data-role="list-divider">客户投诉内容</li>
        <li  class="ui-field-contain">
      		<div  class="ui-grid-a">
        		<p style="white-space: normal;">{{$accept->content}}</p>
	  		</div>
        	<div  class="ui-grid-a"  style="white-space: normal;">
			 @foreach ($accept->files as $file)
		  	 <a href="{{ URL::to('wx/img/'.$file->filename) }}" data-ajax="false"><img src="{{ URL::asset('data/'.$file->filename) }}" style="height: 80px;"></a>
			 @endforeach
	  		</div>
        </li>
        <li  class="ui-field-contain">
			<p>创建时间:{{$accept->create_at}}</p>
        </li>
    </ul>