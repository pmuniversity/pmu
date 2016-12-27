@extends('layouts.admin') @section('content')
<!-- Column selectors -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $topicTitle }}</h5>
		<span id="topicId" style="display: none;">{{ $topicId }}</span> <span
			id="articleType" style="display: none;">{{ $articleType }}</span>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<table class="table dtable-btn-html5-article-by-type">
		<thead>
			<tr>
				<th>ID</th>
				<th>Topic ID</th>
				<th>Title</th>
				<th>Sequence</th>
				<th>Posted On</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>
	</table>
</div>
<!-- /column selectors -->
@endsection
