<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('blog.meta.keywords') }}">
    <meta name="description" content="{{ config('blog.meta.description') }}">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ config('blog.default_mobile_icon') }}">

    <title>{{ fullTitle($topic->title) }}</title>

    @yield('before_styles')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/style-mobile.css" rel="stylesheet">
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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/" title="">
                    <img height="35" src="{{ '/images/'.$device.'/logo-inner.png' }}" alt="{{ config('app.name') }}">
                </a>
            </div>
        </div>
    </nav>
    <!--//Header-->

    <!--Inner Banner-->
    <section class="inner-banner">
        <div class="caption">
            <h1><span>{{$topic->title}}</span></h1>

            <p><span>{!! $topic->summary !!}</span>
            </p>
        </div>
    </section>
    <!--//Inner Banner-->

    <!--Category Tabs-->
    <tabs>
        <tab name="TOP 10" :selected="true">
        </tab>
        <tab name="LATEST">
        </tab>
        <tab name="VIDEOS">
        </tab>
        <tab name="BOOKS">
        </tab>
        <tab name="INTERVIEWS">
        </tab>
        <tab name="TOOLS">
        </tab>
    </tabs>
    <!--//Category Tabs-->

    <!--Articles-->

    <!--//Articles-->

    <!--Special Section-->
    <section class="special-section">
        <div class="container">
            <div class="special-article" id="special-article">
                <span style="display: none;">{{ $topic->id }} </span>

                <h2>{{$topic->note_title}}</h2>

                <p>{!! $topic->note_description !!}</p>
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
    @include("$device.partials.footer")
            <!--//Footer-->

    <!--Copy Rights-->
    <div class="copyrights">
        <p>© Looptabs | All rights reserved</p>
    </div>
    <!--//Copy Rights-->
</div>
</div>

@yield('before_scripts')

@yield('scripts')
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script src="/js/jquery-scrolltofixed-min.js"></script>
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
        // Email
        $('body').on({
            click: function () {
                $(this).siblings('.email-input').focus();
                $(this).remove();
            }
        }, '.required-field');
    });
</script>
<!-- GA script -->
@include('ga')
        <!-- //GA script -->

@yield('after_scripts')

        <!-- JavaScripts -->

</body>
</html>
