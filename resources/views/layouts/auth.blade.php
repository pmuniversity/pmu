<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
<link
	href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900"
	rel="stylesheet" type="text/css">
<link href="/assets/admin/css/icons/icomoon/styles.css" rel="stylesheet">
<link href="/assets/admin/css/bootstrap.css" rel="stylesheet">
<link href="/assets/admin/css/core.css" rel="stylesheet">
<link href="/assets/admin/css/components.css" rel="stylesheet">
<link href="/assets/admin/css/colors.css" rel="stylesheet" type="text/css">

<!-- Core JS files -->
<script type="text/javascript"
	src="/assets/admin/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript"
	src="/assets/admin/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript"
	src="/assets/admin/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript"
	src="/assets/admin/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->


<!-- Theme JS files -->
<script type="text/javascript"
	src="/assets/admin/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/core/app.js"></script>
<script type="text/javascript" src="/assets/admin/js/pages/login.js"></script>
<!-- /theme JS files -->
<!-- Scripts -->

<script>
        window.Laravel = <?php
								echo json_encode ( [ 
										'csrfToken' => csrf_token () 
								] );
								?>
    </script>
</head>
<body class="login-container">
	<div>
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}"> {{
						config('app.name', 'Laravel') }} </a>
				</div>
			</div>
		</nav>

		@yield('content')
	</div>

</body>
</html>