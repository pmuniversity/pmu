<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible"
	content="IE=11; IE=10; IE=9; IE=8; IE=EDGE">
<meta charset="utf-8" />
<title>PMU | {{ $topic->title }}</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<link rel="stylesheet" href="{{ elixir('css/all.css', null) }}">
</head>
<body>
	<div id="app">
		<!--Header-->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#navbar" aria-expanded="false"
						aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/" title=""><img width="40"
						height="20" src="{{ asset('images/web/logo.png') }}"
						alt="Product Manager University"></a>
				</div>
				<div class="col-md-4">
					<div class="arrow">
						<i class="material-icons">&#xE315;</i>
					</div>
					<div class="article-title">{{ $topic->levelTitle }}</div>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav  navbar-right">
						<li><a href="#"><i class="material-icons">&#xE8B6;</i></a></li>
						<li><a class="navbar-profile" href=""> H </a></li>
						<li><a href="#" data-toggle="dropdown"> <i class="material-icons">&#xE3C7;</i>
						</a>
							<ul class="dropdown-menu pmu-caret">
								<li class="active"><a href="#"><span>my profile</span></a></li>
								<li><a href="#"><span>settings</span></a></li>
							</ul></li>
					</ul>
				</div>
			</div>
		</nav>
		<!--//Header-->

		<!--Inner Banner-->
		<section class="inner-banner">
			<div class="caption">
				<h1>
					<span>Product Manager University</span>
				</h1>
				<p>
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						Morbi eleifend ornare Aliquam gravida et elit sed vulputate
						pharetra mattis risus vehicula.</span>
				</p>
			</div>
		</section>
		<!--//Inner Banner-->

		<!--Category Tabs-->

		<tabs> <tab name="TOP 10" :selected="true"> </tab> <tab name="LATEST">

		</tab> <tab name="VIDEOS"> </tab> <tab name="BOOKS"> </tab> <tab
			name="INTERVIEWS"> </tab> <tab name="NOTES"> </tab> </tabs>


		<!--//Category Tabs-->

		<!--Articles-->

		<!--//Articles-->

		<!--Special Section-->
		<section class="special-section">
			<div class="container">
				<div class="special-article" id="special-article">
					<span style="display: none;">{{ $topic->id }} </span>
					<h2>{{ $topic->title }}</h2>
					<p>{{ $topic->description }}</p>
				</div>
				<div class="text-center">
					<a class="read-more" href="#">Read more</a>
				</div>
			</div>
		</section>
		<!--//Special Section-->

		<!--Footer-->
		<footer class="common-section" style="background-color: #333;">
			<div class="container">
				<h2>LIKE WHAT YOU SEE?</h2>
				<h4>Like what you see?</h4>
				<div class="contact-us">
					<div class="contact-us-form">
						<form action="/api/user" method="post" v-on:submit.prevent="submitForm">
							{!! csrf_field() !!} 
								<input type="text" name="email" id="email"
								class="email-input" placeholder="Send us an email" v-model="formInputs.email"/> 
								
							<input type="submit"
								name="submit" class="submit-button" value="Send" /> <span
								class="required-field">Required</span>
						</form>
						<div v-if="successMessage" class="success-message">@{{ successMessage }}</div>
						<div v-if="formErrors" class="success-message">@{{ formErrors[0] }}</div>
					</div>
					<ul class="social-list">
						<li class="social-icon facebook"><a href="#" target="_blank"></a></li>
						<li class="social-icon twitter"><a href="#" target="_blank"></a></li>
						<li class="social-icon linkedin"><a href="#" target="_blank"></a></li>
						<li class="social-icon gmail"><a href="#" target="_blank"></a></li>
					</ul>
				</div>

			</div>
		</footer>
		<!--//Footer-->

		<!--Copy Rights-->
		<div class="copyrights">
			<p>© Looptabs | All rights reserved</p>
		</div>
		<!--//Copy Rights-->
	</div>
	<script>
    window.Laravel = <?php
				echo json_encode ( [ 
						'csrfToken' => csrf_token () 
				] );
				?>
</script>
	<script src="{{ elixir('js/app.js', null) }}"></script>
	<script type="text/javascript">

	$(document).ready(function() {
    
	
	/* error message element hide on focus */
	$('body').on({
		click: function () {
			$(this).siblings('.email-input').focus();
			$(this).remove();
		}
	}, '.required-field');
	/*end*/


});

</script>
</body>
</html>