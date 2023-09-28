@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	{{ Session::get('success') }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-warning alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
	<strong>Error!</strong> {{ Session::get('error') }}
</div>
@endif