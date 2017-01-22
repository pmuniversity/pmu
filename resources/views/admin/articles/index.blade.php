@extends('layouts.admin') @section('content')
<!-- Column selectors -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $pageTitle }}</h5>
		<span id="titleId" style="display: none;">{{ $topicId }}</span>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a href="/admin/articles/create?topicId={{ $topicId }}" class="icon-plus3"
					title="Add an articls"></a></li>
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<table class="table datatable-button-html5-article-columns">
		<thead>
			<tr>
				<th>ID</th>
				<th>Topic ID</th>
				<th>Title</th>
				<th>Type</th>
				<th>Posted On</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
	</table>
</div>
<!-- /column selectors -->
@endsection
