@extends('layouts.admin') @section('content')
<!-- Column selectors -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $pageTitle }}</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>

	<table class="table datatable-button-html5-user-columns">
		<thead>
			<tr>
				<th>id</th>
				<th>Full name</th>
				<th>E-mail</th>
				<th>Role</th>
			</tr>
		</thead>
	</table>
</div>
<!-- /column selectors -->
@endsection
