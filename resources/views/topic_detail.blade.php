<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible"
	content="IE=11; IE=10; IE=9; IE=8; IE=EDGE">
<meta charset="utf-8" />
<title>PMU | {{ $topic->title }}</title>
<link rel="shortcut icon" href="/images/web/favicon.ico">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<link rel="stylesheet" href="{{ elixir('css/all.css', null) }}">
</head>
<body>
	<progress value="0" id="progressBar" class="flat">
		<div class="progress-container">
			<span class="progress-bar"></span>
		</div>
	</progress>
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
					<a class="navbar-brand" href="/" title=""><img height="35"
						src="/images/web/logo-inner.png" alt="{{ config('app.name') }}"></a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav  navbar-right">@include('partials._top_nav')
					</ul>
				</div>
			</div>
		</nav>
		<!--//Header-->

		<!--Inner Banner-->
		<section class="inner-banner">
			<div class="caption">
				<h1>
					<span>{{ $topic->title }}</span>
				</h1>
				<p>
					<span>{!! $topic->summary !!}</span>
				</p>
			</div>
		</section>
		<!--//Inner Banner-->

		<!--Category Tabs-->

		<tabs> <tab name="TOP 10" :selected="true"> </tab> <tab name="LATEST">

		</tab> <tab name="VIDEOS"> </tab> <tab name="BOOKS"> </tab> <tab
			name="INTERVIEWS"> </tab> <tab name="TOOLS"> </tab> </tabs>


		<!--//Category Tabs-->

		<!--Articles-->

		<!--//Articles-->

		<!--Special Section-->
		<section class="special-section">
			<div class="container">
				<div class="special-article" id="special-article">
					<span style="display: none;">{{ $topic->id }} </span>
					<h2>{{ $topic->noteTitle }}</h2>
					<p>{!! $topic->description !!}</p>
				</div>
			</div>
		</section>
		<!--//Special Section-->
		<!--Next Previous Section-->
		<section class="next-previous-section">
			<div class="container">
				@if($nextTopic)
				<div class="pull-left">
					<a href="{{ url($nextTopic->slug)}}"><i class="material-icons">&#xE314;</i>
						{{ $nextTopic->title }} </a>
				</div>
				@endif @if($previousTopic)
				<div class="pull-right">
					<a href="{{ url($previousTopic->slug)}}">{{ $previousTopic->title
						}} <i class="material-icons">&#xE315;</i>
					</a>
				</div>
				@endif
			</div>
		</section>
		<!--//Next Previous Section-->

		<!--Footer-->
		<footer class="common-section" style="background-color: #333;">
			<div class="container">
				<h2>LIKE WHAT YOU SEE?</h2>
				<h4>Like what you see?</h4>
				<div class="contact-us">
					<div class="contact-us-form">
						<form action="/api/user" method="post"
							v-on:submit.prevent="submitForm">
							{!! csrf_field() !!} <input type="text" name="email" id="email"
								class="email-input" placeholder="Send us an email"
								v-model="formInputs.email" /> <input type="submit" name="submit"
								class="submit-button" value="Send" :disabled="disabledButton" />
							<span class="required-field">Required</span>
						</form>
						<div v-if="successMessage" class="success-message">@{{
							successMessage }}</div>
						<div v-if="formErrors" class="success-message">@{{ formErrors[0]
							}}</div>
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
	<script src="/js/jquery-scrolltofixed-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.inner-tabs').scrollToFixed({
	        marginTop: $('.navbar-default').outerHeight(true),
	        limit: $('.special-section').offset().top
	    });
		var getMax = function(){
	        return $(document).height() - $(window).height();
	    }
	    
	    var getValue = function(){
	        return $(window).scrollTop();
	    }
	    
	    if('max' in document.createElement('progress')){
	        var progressBar = $('progress');
			
	        progressBar.attr({ max: getMax() });

	        $(document).on('scroll', function(){
	            progressBar.attr({ value: getValue() });
	        });
	      
	        $(window).resize(function(){
	            progressBar.attr({ max: getMax(), value: getValue() });
	        });   
	    }
	    else {
	        var progressBar = $('.progress-bar'), 
	            max = getMax(), 
	            value, width;
	        
	        var getWidth = function(){
	            // Calculate width in percentage
	            value = getValue();            
	            width = (value/max) * 100;
	            width = width + '%';
	            return width;
	        }
	        
	        var setWidth = function(){
	            progressBar.css({ width: getWidth() });
	        }
	        
	        $(document).on('scroll', setWidth);
	        $(window).on('resize', function(){
	            max = getMax();
	            setWidth();
	        });
	    }
    
	
	/* error message element hide on focus */
	$('body').on({
		click: function () {
			$(this).siblings('.email-input').focus();
			$(this).remove();
		}
	}, '.required-field');
	/*end*/
	/* 
	 * GA tracking code	
	*/
	<?php
	if (config ( 'app.env' ) === 'production') {
		?>
		 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', <?php echo "'".config('blog.google.id')."'";?>, 'auto');
			  ga('send', 'pageview');
	<?php
	}
	?>	


});

</script>
</body>
</html>