<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="description" content="Picard Html vCard">
    <meta name="keywords" content="business, personal, portfolio">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}"/> <!-- bootstrap grid -->
    <link rel="stylesheet"  href="{{asset('assets/css/style_.css')}}"/> <!-- template css -->
    <link rel="stylesheet" href="{{asset('assets/css/reset.css')}}"/> <!-- reset css -->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}"/> <!-- magnific popup css -->
    <link href="{{asset('assets/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" /> <!-- right menu scrollbar css -->


    <!-- Color Alternatives -->
    <link href="{{asset('assets/css/colors/switcher.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors/color-1.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors/color-2.css')}}" rel="alternate stylesheet" type="text/css" title="color-2">
    <link href="{{asset('assets/css/colors/color-3.css')}}" rel="alternate stylesheet" type="text/css" title="color-3">
    <link href="{{asset('assets/css/colors/color-4.css')}}" rel="alternate stylesheet" type="text/css" title="color-4">
    <link href="{{asset('assets/css/colors/color-5.css')}}" rel="alternate stylesheet" type="text/css" title="color-5">
    <link href="{{asset('assets/css/colors/color-6.css')}}" rel="alternate stylesheet" type="text/css" title="color-6">
    <link href="{{asset('assets/css/colors/color-7.css')}}" rel="alternate stylesheet" type="text/css" title="color-7">
    <link href="{{asset('assets/css/colors/color-8.css')}}" rel="alternate stylesheet" type="text/css" title="color-8">


    <!-- Google Web fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

    <!-- Font icons -->
    <link rel="stylesheet" href="{{asset('assets/icon-fonts/font-awesome-4.4.0/css/font-awesome.min.css')}}"/> <!-- Fontawesome icons css -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA8Lqb0P4RLF9_3jCi6VhIYFbttZDeV_bM"></script>
    @yield('css')

</head>

<body>
<div id="wrapper">
    <div class="container">
        <div class="row">

            <!-- Profile Informations-->
            <div class="profile col-md-3 wow fadeInDown">
                <div class="profile-image">
                    <img alt="image" src="{{asset('storage/'.$personal->image)}}" alt="{{$personal->full_name}}">
                </div>
                <div class="profile-info">
                    <div class="name-job">
                        <h1>{{$personal->full_name}}</h1>
                        <span class="job"> {{$personal->task_name}} </span>
                    </div><!-- .name-job -->
                    <div class="social-icons">
                        @foreach($socialMediaData as $item)
                        <a class="facebook" href="{{$item->link ? $item->link : 'javascript:void(0)'}}" target="_blank" title="{{$item->name}}">
                            <i class="{!!$item->icon!!}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div> <!--.profile .col-md-3-->

            <!--Right Section-->
            <div id="tab-container" class="col-md-9">
                <!--Top Menu -->
                <ul class="top-menu">
                    <li class={{Route::is('index') ?  'active' : ''}}> <a class="page-scroll" href="{{route('index')}}"><i class="fa fa-user"></i> <span> HAKKIMDA </span></a></li>
                    <li class={{Route::is('resume') ?  'active' : ''}}> <a class="page-scroll" href="{{route('resume')}}"><i class="fa fa-file-text-o"></i>  <span> ÖZGEÇMİŞİM </span></a></li>
                    <li class={{Route::is('portfolyo') ?  'active' : ''}}> <a class="page-scroll" href="{{route('portfolyo')}}"><i class="fa fa-picture-o"></i>  <span> PORTFOLYO</span></a></li>
                    <li class={{Route::is('blog') ?  'active' : ''}}> <a class="page-scroll" href="https://ogulcanaltunorgu.com"><i class="fa fa-comments"></i> <span> BLOG</span></a></li>
                    <li class={{Route::is('iletisim') ?  'active' : ''}}> <a class="page-scroll" href="{{route('iletisim')}}"><i class="fa fa-map-marker"></i> <span> İLETİŞİM </span></a></li>
                </ul>
@yield('content')

            </div> <!-- #tab-container .col-md-9 end -->
        </div> <!-- .row end-->
    </div><!-- .container end -->
</div> <!-- #wrapper end-->


<!-- Javascripts -->
<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script><!-- jQuery library -->
<script src="{{asset('assets/js/jquery.easytabs.min.js')}}"></script>
<script src="http://maps.google.com/maps/api/js?"></script>
<script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script><!-- Isotope js -->
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script><!-- Magnific Popup js -->
<script src="{{asset('assets/js/styleswitcher.js')}}"></script>
<script src="{{asset('assets/perfect-scrollbar/jquery.mousewheel.js')}}"></script>
<script src="{{asset('assets/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script><!-- Main js -->

<script type="text/javascript">
    $(document).ready( function() {

        // PAGE TABS
        $('#tab-container').easytabs({
            updateHash		: false,
            animate			: false,
            transitionIn	:'fadeIn',
            transitionOut	:'fadeOut',
            tabActiveClass	:'active',
            transitionInEasing: 'linear',
            transitionOutEasing: 'linear'
        });

        // PORTFOLIO ISOTOPE
        $(".portfolio_items").isotope({
            itemSelector: '.single_item',
            layoutMode: 'fitRows',
            columnWidth: '.col-sm-3'
        });

        // isotope click function

        $('.portfolio_filter ul li').click(function(){
            $(".portfolio_filter ul li").removeClass("select-cat");
            $(this).addClass("select-cat");

            var selector = $(this).attr('data-filter');
            $(".portfolio_items").isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });
            return false;
        });

        // MAGNIFIC POPUP FOR PORTFOLIO PAGE
        $('.image-link').magnificPopup({
            type:'image'
        });


        //PAGE SMOOTH SCROLL
        $(function() {

            $('a.page-scroll').bind('click', function(event) {
                if ($(window).width() < 750 ) {
                    $('.top-menu li').slideUp();
                    var $anchor = $(this);
                    $('html, body').stop().animate({
                        scrollTop: $($anchor.attr('href')).offset().top - 91
                    }, 1000);
                    event.preventDefault();
                };
            });
        });


        // GOOGLE MAP
        $('#wrapper').bind('easytabs:after', function() {

            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(40.801485408197856, -73.96745953467104), //change the coordinates
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                mapTypeControl: false
            };

            var map = new google.maps.Map(document.getElementById("map"), myOptions);
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(40.801485408197856, -73.96745953467104) //change the coordinates
            });
            var infowindow = new google.maps.InfoWindow({
                content: "<b>CHRIS JOHNSON</b><br/>2550 Santa Monica Boulevard<br/> Los Angeles"  //add your address
            });
            google.maps.event.addListener(marker, "click", function () {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);

        });


        // TOP MENU ACTIVE

        $('ul.top-menu li a').click(function(){
            $('ul.top-menu li a').removeClass("selected");
            $(this).addClass("selected");

        });


    });


</script>
@yield('js')


</body>
</html>
