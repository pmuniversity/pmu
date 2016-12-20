<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible"
	content="IE=11; IE=10; IE=9; IE=8; IE=EDGE">
<meta charset="utf-8" />
<title>PMU | Product Manager University</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<link rel="stylesheet" href="{{ elixir('css/all.css', null) }}">

</head>
<body>
	<div id="app">
		<!--Header-->
		@if (!Auth::guest())
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav  navbar-right">@include('partials._top_nav')
					</ul>
				</div>
			</div>
		</nav>
		@endif
		<!--//Header-->
		<!--Banner-->
		<section class="main-banner">
			<div class="banner-logo">

				<img src="{{ asset('images/web/logo.png') }}" />
			</div>

			<div class="caption">
				<h1>
					<span>Product Manager University</span>
				</h1>
				<p>
					<span>A free, game-changing online university for technology
						product managers - all accessible in the cloud! Learn all aspects
						of Product Management from some of the leading product managers of
						Silicon Valley!<br /> Attain a Bachelor's and/or Master's degree
						in Product Management that can land you your dream job or help you
						hone your skills as an innovative Product Manager!
					</span>
				</p>
			</div>

		</section>
		<!--//Banner-->

		<!--BACHELOUR'S DEGREE-->
		<bachelore-topics></bachelore-topics>
		<!--//BACHELOUR'S DEGREE-->

		<!--MASTER'S DEGREE-->
		<master-topics></master-topics>
		<!--//MASTER'S DEGREE-->

		<!--SPECIALIZATION-->
		<specialization-topics></specialization-topics>
		<!--//SPECIALIZATION-->

		<!--HALLS OF KNOWLEDGE-->
		<section class="common-section" style="background-color: #f2f2f2;">
			<div class="container">
				<h2>HALLS OF KNOWLEDGE</h2>
				<p>Learn about Product Management from thought leaders across the
					world by accessing these free courses, blogs, and podcasts focused
					on proven methods in product management.</p>
				<div class="knowledge">
					<div class="row">
						<div class="col-md-4">
							<div class="k-list-item">
								<div class="list-image">
									<img src="{{ asset('images/web/knowledge-class.png') }}" />
								</div>
								<div class="list-desc">
									<div class="list-desc-details">
										<p>Product Manager Courses</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="k-list-item">
								<div class="list-image">
									<img src="{{ asset('images/web/knowledge-class.png') }}" />
								</div>
								<div class="list-desc">
									<div class="list-desc-details">
										<p>Product Manager Courses</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="k-list-item">
								<div class="list-image">
									<img src="{{ asset('images/web/knowledge-class.png') }}" />
								</div>
								<div class="list-desc">
									<div class="list-desc-details">
										<p>Product Manager Courses</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//HALLS OF KNOWLEDGE-->

		<!--PLACEMENTS-->
		<section class="common-section">
			<div class="container">
				<h2>PLACEMENTS</h2>
				<p>Learn how to get interviews and land jobs as a first time Product
					Manager, create a winning resume and portfolio, and build your
					brand as a thought leader and successful product manager. Also take
					advantage of the benefits of PM University's career placement
					program by submitting your resume for PM University contributors to
					find a fit for you to begin your career as a Product Manager!</p>
				<div class="placement-list">
					<div class="media">
						<div class="pull-left">
							<img src="{{ asset('images/web/pm-interviews.png') }}" />
						</div>
						<div class="media-body">
							<h4 class="p-list-header">Product Managment jobs</h4>
							<div class="p-list-desc">Lorem ipsum dolor sit amet, consectetur
								adipiscing elit. Morbi eleifend ornare lorem. Aliquam gravida et
								elit sed vulputate.</div>
							<div class="p-list-link">
								<a href="#">Read more &raquo;</a>
							</div>
						</div>
					</div>
					<div class="media">
						<div class="pull-left">
							<img src="{{ asset('images/web/pm-interviews.png') }}" />
						</div>
						<div class="media-body">
							<h4 class="p-list-header">Product Managment jobs</h4>
							<div class="p-list-desc">Lorem ipsum dolor sit amet, consectetur
								adipiscing elit. Morbi eleifend ornare lorem. Aliquam gravida et
								elit sed vulputate.</div>
							<div class="p-list-link">
								<a href="#">Read more &raquo;</a>
							</div>
						</div>
					</div>
					<div class="media">
						<div class="pull-left">
							<img src="{{ asset('images/web/pm-interviews.png') }}" />
						</div>
						<div class="media-body">
							<h4 class="p-list-header">Product Managment jobs</h4>
							<div class="p-list-desc">Lorem ipsum dolor sit amet, consectetur
								adipiscing elit. Morbi eleifend ornare lorem. Aliquam gravida et
								elit sed vulputate.</div>
							<div class="p-list-link">
								<a href="#">Read more &raquo;</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//PLACEMENTS-->

		<!--Footer-->
		<footer class="common-section" style="background-color: #333;">
			<div class="container">
				<h2>LIKE WHAT YOU SEE?</h2>
				<h4>Like what you see?</h4>
				<div class="contact-us">
					<div class="contact-us-form">
						<form>
							<input type="text" name="email" class="email-input"
								placeholder="Send us an email" /> <input type="button"
								name="submit" class="submit-button" value="Send" /> <span
								class="required-field">Required</span>
						</form>
						<div class="success-message">Success message will come here</div>
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
			<p>&copy; Looptabs | All rights reserved</p>
		</div>
	</div>
	<!--//Copy Rights-->
	<script>
    window.Laravel = <?php
				echo json_encode ( [ 
						'csrfToken' => csrf_token () 
				] );
				?>
</script>
	<script src="{{ elixir('js/app.js', null) }}"></script>
	<script>
	
$(document).ready(function() {
	msBG();
	$(window).resize(msBG);
	
	function msBG() {
		$('.main-banner').css('height', $(window).height() +'px')
	}

	
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