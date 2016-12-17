<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.partials._head')
<!-- Scripts -->

<script>
        window.Laravel = <?php
								echo json_encode ( [ 
										'csrfToken' => csrf_token () 
								] );
								?>
    </script>
</head>
<body>
	@include('admin.partials._main_nav_bar')
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">
			@include('admin.partials._sidebar')
			<!-- Main content -->
			<div class="content-wrapper">
				@include('admin.partials._page_header')
				<!-- Content area -->
				<div class="content">@yield('content')</div>
				<!-- /content area -->
			</div>
		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<script>
    $('#flash-overlay-modal').modal();
</script>

</body>
</html>