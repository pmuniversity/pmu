<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11; IE=10; IE=9; IE=8; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('blog.meta.keywords') }}">
    <meta name="description" content="{{ config('blog.meta.description') }}">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ config('blog.default_mobile_icon') }}">

    <title>@yield('title', config('app.name'))</title>

    @yield('before_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="/css/style-mobile.css"
          rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @yield('styles')

    @yield('after_styles')

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<progress value="0" id="progressBar" class="flat">
    <div class="progress-container">
        <span class="progress-bar"></span>
    </div>
</progress>
<div id="app">
    <!--Header-->
    @if (!Auth::guest())
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav  navbar-right">
                    </ul>
                </div>
            </div>
        </nav>
        @endif
                <!--//Header-->
        <!--Banner-->
        <section class="main-banner">
            <div class="banner-logo">
                <img src="/images/{{ config('blog.mobile_title') }}/logo.png"/>
            </div>

            <div class="caption">
                <h1>
                    <span>{{ config('app.name') }}</span>
                </h1>

                <p>
                <span>A free, game-changing online university for product managers!
                    Learn all aspects of Product Management from some of the leading
                    product managers of Silicon Valley. </span>
                </p>
            </div>

        </section>
        <!--//Banner-->
        <!--BACHELOUR'S DEGREE-->
        <section class="common-section">
            <div class="container">
                <h2>BACHELOUR'S DEGREE</h2>

                <p>Learn the basics of Product Management. Topics range from how to
                    be a product manager, working with teams as a PM to creating
                    product roadmaps that lead to truly amazing products!</p>
                <ul class="pm-list">
                    @foreach($bachelorTopics as $key => $topic)
                        <li>
                            <a class="{{classActiveTopic($key)}}" href="/{{$topic->slug}}">
                                <div class="media">
                                    <div class="media-left"><span class="pm-list-count">{{$key += 1}}.</span></div>
                                    <div class="media-body">{{$topic->title}}</div>
                                    <div class="media-right"><span class="r-more">READ</span></div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!--//BACHELOUR'S DEGREE-->

        <!--MASTER'S DEGREE-->
        <section class="common-section">
            <div class="container">
                <h2>MASTER'S DEGREE</h2>

                <p>Already a Product Manager or think you've got the skills to go after a Master's Degree in Product
                    Management? Learn advanced topics in product management.</p>
                <ul class="pm-list">
                    @foreach($masterTopics as $key => $topic)
                        <li>
                            <a class="{{classActiveTopic($key)}}" href="/{{$topic->slug}}">
                                <div class="media">
                                    <div class="media-left"><span class="pm-list-count">{{$key += 1}}.</span></div>
                                    <div class="media-body">{{$topic->title}}</div>
                                    <div class="media-right"><span class="r-more">READ</span></div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!--//MASTER'S DEGREE-->
        <!--SPECIALIZATION-->
        <section class="common-section">
            <div class="container">
                <h2>SPECIALIZATION</h2>

                <p>Dig deeper into the discipline of product management and dive into twenty advanced product management
                    courses that truly put your skills to the test!</p>
                <ul class="specialisation-list">
                    @foreach($specTopics as $key => $topic)
                        <li>
                            <a class="{{classActiveTopic($key)}}" href="/{{$topic->slug}}">
                                <div>
                                    <img src="{{asset($topic->web_picture)}}"
                                         alt="{{$topic->title}}"
                                         class="s-list-icon"/>
                                </div>
                                <div class="s-list-name">{{$topic->title}}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!--//SPECIALIZATION-->

        <!--HALLS OF KNOWLEDGE-->
        <section class="common-section" style="background-color: #f2f2f2;">
            <div class="container">
                <h2>{{ $hallsofKnowledge->title }}</h2>

                <p>{{ $hallsofKnowledge->description }}</p>

                <div class="knowledge">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="k-list-item">
                                <div class="list-image">
                                    <img src="{{asset($hallsofKnowledge->image_1_mobile_picture)}}"/>
                                </div>
                                <div class="list-desc">
                                    <div class="list-desc-details">
                                        <p>{{$hallsofKnowledge->image_1_title}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="k-list-item">
                                <div class="list-image">
                                    <img src="{{asset($hallsofKnowledge->image_2_mobile_picture)}}"/>
                                </div>
                                <div class=" list-desc">
                                    <div class="list-desc-details">
                                        <p>{{$hallsofKnowledge->image_3_title}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="k-list-item">
                                <div class="list-image">
                                    <img src="{{asset($hallsofKnowledge->image_3_mobile_picture)}}"/>
                                </div>
                                <div class="list-desc">
                                    <div class="list-desc-details">
                                        <p>{{$hallsofKnowledge->image_3_title}}</p>
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

                <p>Learn how to get interviews and land jobs as a first time Product Manager, create a winning resume
                    and portfolio, and build your brand as a thought leader and successful product manager. Also take
                    advantage of the benefits of PM University's career placement program by submitting your resume for
                    PM University contributors to find a fit for you to begin your career as a Product Manager!</p>

                <div class="placement-list">
                    <div class="media">
                        <div class="pull-left">
                            <img src="{{asset('images/'.config('blog.desktop_title').'/pm-jobs.png')}}"/>
                        </div>
                        <div class="media-body">
                            <h4 class="p-list-header">PRODUCT MANAGMENT JOBS</h4>

                            <div class="p-list-desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Morbi eleifend ornare lorem. Aliquam gravida et elit sed
                                vulputate.
                            </div>
                            <div class="p-list-link">
                                <a href="#">Read more &raquo;</a>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="pull-left">
                            <img src="{{asset('images/'.config('blog.desktop_title').'/pm-interviews.png') }}"/>
                        </div>
                        <div class="media-body">
                            <h4 class="p-list-header">PRODUCT MANAGEMENT INTERVIEWS</h4>

                            <div class="p-list-desc">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Morbi eleifend ornare lorem. Aliquam gravida et elit sed
                                vulputate.
                            </div>
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
        @include('desktop.partials.footer')
                <!--//Footer-->

        <!--Copy Rights-->
        <div class="copyrights">
            <p>© Looptabs | All rights reserved</p>
        </div>
        <!--//Copy Rights-->
</div>

@yield('before_scripts')

@yield('scripts')
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script src="/js/carousel.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
<!-- page script -->
<script type="text/javascript">
    $(document).ready(function () {
        var getMax = function () {
            return $(document).height() - $(window).height();
        }

        var getValue = function () {
            return $(window).scrollTop();
        }

        if ('max' in document.createElement('progress')) {
            var progressBar = $('progress');

            progressBar.attr({max: getMax()});

            $(document).on('scroll', function () {
                progressBar.attr({value: getValue()});
            });

            $(window).resize(function () {
                progressBar.attr({max: getMax(), value: getValue()});
            });
        }
        else {
            var progressBar = $('.progress-bar'),
                    max = getMax(),
                    value, width;

            var getWidth = function () {
                // Calculate width in percentage
                value = getValue();
                width = (value / max) * 100;
                width = width + '%';
                return width;
            }

            var setWidth = function () {
                progressBar.css({width: getWidth()});
            }

            $(document).on('scroll', setWidth);
            $(window).on('resize', function () {
                max = getMax();
                setWidth();
            });
        }
    });
</script>
<!-- GA script -->
@include('ga')
        <!-- //GA script -->

@yield('after_scripts')

        <!-- JavaScripts -->

</body>
</html>
