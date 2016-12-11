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
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav  navbar-right">
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
					<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						Morbi eleifend ornare Aliquam gravida et elit sed vulputate
						pharetra mattis risus vehicula.</span>
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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
					eleifend ornare lorem. Aliquam gravida et elit sed vulputate</p>
				<div class="knowledge">
					<div class="row">
						<div class="col-md-4">
							<div class="k-list-item active">
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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
					eleifend ornare lorem. Aliquam gravida et elit sed vulputate</p>
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

		<!--OUR TEAM-->
		<section class="common-section" style="background-color: #f2f2f2;">
			<div class="container">
				<h2>OUR TEAM</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
					eleifend ornare lorem. Aliquam gravida et elit sed vulputate</p>
				<div class="our-team">
					<div class="row">
						<div class="col-md-6">
							<div class="our-team-list">
								<div class="our-team-image">
									<img src="{{ asset('images/web/pm-full-image.png') }}" />
								</div>
								<div class="team-desc">
									<div class="team-desc-details">
										<div class="team-name">Vijil C</div>
										<div class="team-designation">Product Manager - My Company</div>
										<ul class="social-list">
											<li class="social-icon facebook"><a href="#" target="_blank"></a></li>
											<li class="social-icon twitter"><a href="#" target="_blank"></a></li>
											<li class="social-icon linkedin"><a href="#" target="_blank"></a></li>
											<li class="social-icon gmail"><a href="#" target="_blank"></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="our-team-list active">
								<div class="our-team-image">
									<img src="{{ asset('images/web/pm-full-image.png') }}" />
								</div>
								<div class="team-desc">
									<div class="team-desc-details">
										<div class="team-name">Vijil C</div>
										<div class="team-designation">Product Manager - My Company</div>
										<ul class="social-list">
											<li class="social-icon facebook"><a href="#" target="_blank"></a></li>
											<li class="social-icon twitter"><a href="#" target="_blank"></a></li>
											<li class="social-icon linkedin"><a href="#" target="_blank"></a></li>
											<li class="social-icon gmail"><a href="#" target="_blank"></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//OUR TEAM-->

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
			<p>© Looptabs | All rights reserved</p>
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