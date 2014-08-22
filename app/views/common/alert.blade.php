
@if (Session::has('message'))
<div class="alert alert-success fade in" role="alert">
<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	{{ Session::get('message') }}
</div>
@endif