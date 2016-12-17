<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<i class="icon-arrow-left52 position-left"></i> <span
					class="text-semibold">{{ fullTitle($pageTitle) }}</span>
			</h4>
		</div>
		@include('flash::message')		
	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
			@for($i = 0; $i <= count(Request::segments()); $i++)		
			
			@if($i === count(Request::segments()))
			<li class="active">{{Request::segment($i)}}</li> 
			@elseif ($i <
			count(Request::segments()) & $i > 0 && Request::segment($i) === 'admin')			
			<li><a href="/{{Request::segment($i)}}">{{Request::segment($i)}}</a></li>
			@elseif ($i <
			count(Request::segments()) & $i > 0)			
			<li><a href="/admin/{{Request::segment($i)}}">{{Request::segment($i)}}</a></li>
			@endif @endfor
		</ul>
	</div>
</div>
<!-- /page header -->