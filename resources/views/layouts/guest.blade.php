<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{site_config('site_name', config('app.name', 'Laravel'))}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Favicon -->

    <link rel="icon" type="image/x-icon"  href="{{site_config('favicon', '/favicon-32x32.png')}}">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="/assets/css/bootstrap.css?v=1.9">
    <!--Font Awesome css-->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css?v=1.9">
    <!--Magnific css-->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css?v=1.9">
    <!--Owl-Carousel css-->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css?v=1.9">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css?v=1.9">
    <!--Animate css-->
    <link rel="stylesheet" href="/assets/css/animate.min.css?v=1.9">
    <!--Select2 css-->
    <link rel="stylesheet" href="/assets/css/select2.min.css?v=1.9">
    <!--Slicknav css-->
    <link rel="stylesheet" href="/assets/css/slicknav.min.css?v=1.9">
    <!--Bootstrap-Datepicker css-->
    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.min.css?v=1.9">
    <!--Jquery UI css-->
    <link rel="stylesheet" href="/assets/css/jquery-ui.min.css?v=1.9">
    <!--Perfect-Scrollbar css-->
    <link rel="stylesheet" href="/assets/css/perfect-scrollbar.min.css?v=1.9">
    <!--Site Main Style css-->
    <link rel="stylesheet" href="/assets/css/style.css?v=1.9">
    <!--Responsive css-->
    <link rel="stylesheet" href="/assets/css/responsive.css?v=1.9">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!--Jquery js-->
    <script src="/assets/js/jquery-3.0.0.min.js?v=1.9"></script>
    <style>
        @media (min-width: 0px) and (max-width: 992px) {
            .hvbuton{text-align:center;}
        }

        .talepkutu{
            margin-top: 10px;
            padding: 10px;
            border: 3px solid #8BC34A;
            border-radius: 10px;
            background: #f5ffe9;
        }

        .fuar-container {
            z-index: 8888;
            width: 100%; /* Kayan yazının genişliği */
            height: 400px; /* Kayan yazının yüksekliği */
            overflow: hidden; /* Taşan kısımları gizle */
            top:0;


            padding: 10px;
            font-family: Arial, sans-serif;
            font-size: 14px;

        }
        .fuar-items p {
            color:white;
        }
        @media screen and (max-width: 600px) {
            .best_service{
                display:none;
            }
        }

        .fuar-listesi {
            display: block;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .fuar-items {
            animation: kaydir 20s linear infinite;
        }

        @keyframes kaydir {
            0% {
                transform: translateY(0); /* Liste başlıyor */
            }
            100% {
                transform: translateY(-100%); /* Liste sona eriyor ve döngü tekrar başlıyor */
            }
        }

        .fuar-listesi p {
            margin: 10px 0;
        }

        /* Hover efekti: fare üzerine gelince animasyon duracak */
        .fuar-container:hover .fuar-items {
            animation-play-state: paused;
        }

    </style>
    <!-- Scripts -->
    @vite([
//'resources/css/app.css',
 'resources/js/app.js'])
</head>
<body>
<!-- Header Area Start -->
<header class="jobguru-header-area stick-top forsticky page-header">

    <div class="menu-animation">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="site-logo">
                        <a href="{{url('/')}}">
                            <img src="{{site_config('favicon', '/images/logo.png')}}" alt="logo" class="non-stick-logo" style="max-width:unset;height:40px;border-radius: 5px;" />
                            <img src="{{site_config('favicon', '/images/logo.png')}}" alt="stick-logo" class="stick-logo" style="max-width:unset;height:40px;border-radius: 5px;" />
                        </a>
                    </div>
                    <!-- Responsive Menu Start -->
                    <div class="jobguru-responsive-menu"></div>
                    <!-- Responsive Menu Start -->
                </div>
                <div class="col-md-8">
                    <div class="header-menu" style="width:100%">
                        <nav id="navigation">
                            <ul id="jobguru_navigation">
                                <li class=""><a href="{{url('/')}}" >{{__('Home')}}</a>
                                </li>
                                <li class=""><a href="{{route('categories')}}" >{{__('All Categories')}}</a>
                                </li>

                                <li class=""><a href="{{route('contact')}}" >{{__('Contact')}}</a>
                                </li>
                                <li style="border: 1px solid #8BC34A;background: #4CAF50;"><a href="{{route('services.step.create')}}" style="color:#fff !important;">{{__('Become a Provider')}}</a></li>

                            </ul>

                        </nav>

                    </div>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </div>



    <div class="header-right-menu">
        <ul>
            @auth
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            @else
                <li class="girisbutonu"><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ __('Login') }}</a></li>
            @endauth
            <li><x-language-switcher /></li>
        </ul>
    </div>

</header>
<!-- Header Area End -->





<section>
    {{ $slot }}
</section>




<!-- Footer Area Start -->
<footer class="jobguru-footer-area">
    <div class="footer-top section_50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget">
                        @if(!is_null(site_config('logo')))
                            <div class="footer-logo">
                                <a href="/">
                                    <img src="{{site_config('logo')}}"  style="width:200px;border-radius: 5px;" />
                                </a>
                            </div>
                        @endif
                        @if(!is_null(site_config('footer_description')))
                            <p>{{site_config('footer_description')}}</p>
                        @endif

                        <ul class="footer-social">
                            @if(!is_null(site_config("facebook_url")))
                                <li><a href="{{site_config("facebook_url")}}" class="fb"><i class="fa fa-facebook"></i></a></li>
                            @endif
                            @if(!is_null(site_config("twitter_url")))
                                <li><a href="{{site_config("twitter_url")}}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            @endif
                            @if(!is_null(site_config("instagram_url")))
                                <li><a href="{{site_config("instagram_url")}}" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            @endif
                            @if(!is_null(site_config("linkedin_url")))
                                <li><a href="{{site_config("linkedin_url")}}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">

                    <x-last-blog-content />

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-footer-widget footer-contact">
                        <h3>{{__('Contact US')}}</h3>
                        <p><i class="fa fa-edit"></i> <a href="{{route('contact')}}">{{__('Write US')}}</a> </p>
                        @if(!is_null(site_config("contact_phone")))
                            <p><i class="fa fa-phone"></i> {{site_config("contact_phone")}}</p>
                        @endif
                        @if(!is_null(site_config("contact_email")))
                            <p><i class="fa fa-envelope-o"></i> {{site_config("contact_email")}}</p>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-left">
                        <p>{!! __('Copyright &copy; :year',['year'=>date('Y')]) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
</body>

<!--Popper js-->
<script src="/assets/js/popper.min.js?v=1.9"></script>
<!--Bootstrap js-->
<script src="/assets/js/bootstrap.min.js?v=1.9"></script>
<!--Bootstrap Datepicker js-->
<script src="/assets/js/bootstrap-datepicker.min.js?v=1.9"></script>
<!--Perfect Scrollbar js-->
<script src="/assets/js/jquery-perfect-scrollbar.min.js?v=1.9"></script>
<!--Owl-Carousel js-->
<script src="/assets/js/owl.carousel.min.js?v=1.9"></script>
<!--SlickNav js-->
<script src="/assets/js/jquery.slicknav.min.js?v=1.9"></script>
<!--Magnific js-->
<script src="/assets/js/jquery.magnific-popup.min.js?v=1.9"></script>
<!--Select2 js-->
<script src="/assets/js/select2.min.js?v=1.9"></script>
<!--jquery-ui js-->
<script src="/assets/js/jquery-ui.min.js?v=1.9"></script>
<!--Custom-Scrollbar js-->
<script src="/assets/js/custom-scrollbar.js?v=1.9"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownToggle = document.getElementById('languageSwitcher');
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', function() {

                dropdownToggle.find("ul").show();
                var dropdownMenu = dropdownToggle.nextElementSibling;



                if (dropdownMenu) {
                    dropdownMenu.classList.toggle('show');

                }
            });
        }
    });
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66e1d97fea492f34bc11a6ae/1i7h3j76p';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->













<script>
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 1000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.placeholder = this.txt;

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 200;
        }

        setTimeout(function() {
            that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>


</html>
