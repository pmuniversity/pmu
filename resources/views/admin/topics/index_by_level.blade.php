@extends('layouts.admin') @section('content')
<!-- Column selectors -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $pageTitle }}</h5>
		<span id="levelId" style="display: none;">{{ $level->id }}</span>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a href="/admin/topics/create" class="icon-plus3"
					title="Add a topic"></a></li>
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>

			</ul>
		</div>
	</div>
	<table class="table datatable-button-html5-topic-by-level-columns">

		<thead>
			<tr>
				<th>id</th>
				<th>Title</th>
				<th>Level</th>
				<th>Posted On</th>
				<th class="text-center">Actions</th>
				<th class="text-center">Articles</th>
			</tr>
		</thead>
	</table>
</div>
<!-- /column selectors -->
@endsection
