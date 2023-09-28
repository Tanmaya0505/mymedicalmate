@php
$url = url()->current();
$slug = Helper::getSlugUrl($url);
@endphp
<!DOCTYPE html>
<html>
    <head lang="{{ app()->getLocale() }}">
        <!--title>My Medical Mate</title-->
        <script type='text/javascript'>
            title = "My Medical Mate";
            position = 0;
            function scrolltitle() {
                document.title = title.substring(position, title.length) + title.substring(0, position);
                position++;
                if (position > title.length)
                    position = 0;
                titleScroll = window.setTimeout(scrolltitle, 500);
            }
            scrolltitle();
        </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') || Medihelp</title>
        @yield('meta')
        <meta name="keywords" content="@yield('keywords')">
        <meta name="description" content="@yield('description')">
        <link href="{{ asset('frontend-source/images/favicon.ico') }}" rel="icon" type="image/x-icon">
        <link href="{{ asset('frontend-source/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;800&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('frontend-source/css/mainstyle.css') }}?v={{ time() }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend-source/slick/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend-source/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend-source/slick/slick-theme.css') }}">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <style>
            .wow:first-child {
                visibility: hidden;
            }
            .xhr-loading {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: #ffffffa6;
                z-index: 9999;
                display: none;
            }
        </style>
        @yield('style')
    </head>
    <body class="@if($slug == 'login-register') {{'blue-bg'}} @endif">
        <div class="xhr-loading">
            <div class="load-wrap">
                <img src="{{ asset('frontend-source/images/loading.svg') }}" />
            </div>
        </div>
        @include('frontend-source.includes.header')
        @yield('content')
        @include('frontend-source.includes.footer')
        <script src="{{ asset('frontend-source/js/jquery-2.2.0.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend-source/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend-source/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
        <script src="{{ asset('frontend-source/js/scripts.js') }}" type="text/javascript"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script>
            // Wrap every letter in a span
var textWrapper = document.querySelector('.ml6 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml6 .letter',
    translateY: ["1.1em", 0],
    translateZ: 0,
    duration: 750,
    delay: (el, i) => 50 * i
  }).add({
    targets: '.ml6',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
        </script>
        <script>
            $(window).scroll(function (event) {
                function footer()
                {
                    var scroll = $(window).scrollTop();
                    if (scroll > 50)
                    {
                        $(".mb-nav").fadeIn("slow").addClass("show");
                    } else
                    {
                        $(".mb-nav").fadeOut("slow").removeClass("show");
                    }
                }
                footer();
            });
        </script>
        <script>
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4'
            });
        </script>
        <script type="text/javascript">
            const second = 1000,
                    minute = second * 60,
                    hour = minute * 60,
                    day = hour * 24;

            let countDown = new Date('Sep 30, 2021 00:00:00').getTime(),
                    x = setInterval(function () {
                        let now = new Date().getTime(),
                                distance = countDown - now;
                        $("#days").html(Math.floor(distance / (day)));
                        $("#hours").html(Math.floor((distance % (day)) / (hour)));
                        $("#minutes").html(Math.floor((distance % (hour)) / (minute)));
                        $("#seconds").html(Math.floor((distance % (minute)) / second));
                    }, second)
        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".box-container").slick({
                    dots: false,
                    infinite: true,
                    centerMode: false,
                    slidesToShow: 4,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                arrows: false,
                                centerPadding: '40px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: true,
                                centerPadding: '40px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 2
                            }
                        }
                    ]
                });

            });

        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".services-brief-").slick({
                    dots: false,
                    infinite: true,
                    centerMode: false,
                    slidesToShow: 4,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: true,
                                centerPadding: '10px',
                                slidesToShow: 6
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 4
                            }
                        }
                    ]
                });
            });

        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".assistant-box-container-slide").slick({
                    dots: false,
                    infinite: true,
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                arrows: false,
                                centerPadding: '30px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });

            });

        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".lab-box-container").slick({
                    dots: false,
                    infinite: true,
                    centerMode: false,
                    slidesToShow: 4,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '30px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '30px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 479,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '30px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });

            });

        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".tips-box-container").slick({
                    dots: false,
                    infinite: true,
                    centerMode: false,
                    slidesToShow: 4,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '30px',
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '30px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 2
                            }
                        }
                    ]
                });

            });

        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".hero-slide").slick({
                    dots: true,
                    infinite: true,
                    centerMode: true,
                    slidesToShow: 1,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '15px',
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });

            });

        </script>

        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".featureicon-slider").slick({
                    dots: false,
                    infinite: true,
                    arrows: false,
                    centerMode: true,
                    slidesToShow: 6,
                    autoplay: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: false,
                                centerPadding: '30px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                arrows: false,
                                centerMode: false,
                                centerPadding: '15px',
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 479,
                            settings: {
                                arrows: false,
                                centerMode: false,
                                centerPadding: '10px',
                                slidesToShow: 3
                            }
                        }
                    ]
                });

            });

        </script>
        <script src="{{ asset('frontend-source/js/wow.min.js') }}" type="text/javascript" charset="utf-8"></script>
        <script>
            wow = new WOW(
                    {
                        animateClass: 'animated',
                        offset: 100,
                        callback: function (box) {
                            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                        }
                    }
            );
            wow.init();
        </script>
        <script src="{{ asset('frontend-source/js/anime.min.js') }}"></script>
        <script>
            var TxtType = function (el, toRotate, period) {
                this.toRotate = toRotate;
                this.el = el;
                this.loopNum = 0;
                this.period = parseInt(period, 10) || 2000;
                this.txt = '';
                this.tick();
                this.isDeleting = false;
            };

            TxtType.prototype.tick = function () {
                var i = this.loopNum % this.toRotate.length;
                var fullTxt = this.toRotate[i];

                if (this.isDeleting) {
                    this.txt = fullTxt.substring(0, this.txt.length - 1);
                } else {
                    this.txt = fullTxt.substring(0, this.txt.length + 1);
                }

                this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

                var that = this;
                var delta = 200 - Math.random() * 100;

                if (this.isDeleting) {
                    delta /= 2;
                }

                if (!this.isDeleting && this.txt === fullTxt) {
                    delta = this.period;
                    this.isDeleting = true;
                } else if (this.isDeleting && this.txt === '') {
                    this.isDeleting = false;
                    this.loopNum++;
                    delta = 500;
                }

                setTimeout(function () {
                    that.tick();
                }, delta);
            };

            window.onload = function () {
                var elements = document.getElementsByClassName('typewrite');
                for (var i = 0; i < elements.length; i++) {
                    var toRotate = elements[i].getAttribute('data-type');
                    var period = elements[i].getAttribute('data-period');
                    if (toRotate) {
                        new TxtType(elements[i], JSON.parse(toRotate), period);
                    }
                }
                // INJECT CSS
                var css = document.createElement("style");
                css.type = "text/css";
                css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #eee}";
                document.body.appendChild(css);
            };
        </script>
        <script>
            $(document).ready(function () {
                $("#myModalpromo").modal('show');
            });
        </script>
        <script>
            var rangeSlider = function () {
                var slider = $('.range-slider'),
                        range = $('.range-slider__range'),
                        value = $('.range-slider__value');

                slider.each(function () {

                    value.each(function () {
                        var value = $(this).prev().attr('value');
                        $(this).html(value);
                    });

                    range.on('input', function () {
                        $(this).next(value).html(this.value);
                    });
                });
            };
            rangeSlider();
        </script>
        <script>
            $(document).ready(function () {
                // Add minus icon for collapse element which is open by default
                $(".collapse.show").each(function () {
                    $(this).prev(".tog-title").find(".fa").addClass("fa-minus").removeClass("fa-plus");
                });

                // Toggle plus minus icon on show hide of collapse element
                $(".collapse").on('show.bs.collapse', function () {
                    $(this).prev(".tog-title").find(".fa").removeClass("fa-plus").addClass("fa-minus");
                }).on('hide.bs.collapse', function () {
                    $(this).prev(".tog-title").find(".fa").removeClass("fa-minus").addClass("fa-plus");
                });
            });
        </script>
        <script>
            function getVals() {
                // Get slider values
                var parent = this.parentNode;
                var slides = parent.getElementsByTagName("input");
                var slide1 = parseFloat(slides[0].value);
                var slide2 = parseFloat(slides[1].value);
                // Neither slider will clip the other, so make sure we determine which is larger
                if (slide1 > slide2) {
                    var tmp = slide2;
                    slide2 = slide1;
                    slide1 = tmp;
                }

                var displayElement = parent.getElementsByClassName("rangeValues")[0];
                displayElement.innerHTML = "Rs " + slide1 + " - Rs " + slide2 + "";
            }

            window.onload = function () {
                // Initialize Sliders
                var sliderSections = document.getElementsByClassName("range-slider-price");
                for (var x = 0; x < sliderSections.length; x++) {
                    var sliders = sliderSections[x].getElementsByTagName("input");
                    for (var y = 0; y < sliders.length; y++) {
                        if (sliders[y].type === "range") {
                            sliders[y].oninput = getVals;
                            // Manually trigger event first time to display values
                            sliders[y].oninput();
                        }
                    }
                }
            }
        </script>
        <script>
            $(document).ready(function () {
                $(".mb-filter-bar").click(function () {
                    $("aside").slideToggle();
                });
            });
        </script>
        @stack('script')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#menu-close").click(function (e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("active");
            });
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#sidebar-wrapper").toggleClass("active");
            });
        </script>
        <script>
            function switchVisible() {
                

                    if (document.getElementById('Div1').style.display == 'none') {
                        document.getElementById('Div1').style.display = 'block';
                        document.getElementById('Div2').style.display = 'block';
                        document.getElementById('Div3').style.display = 'none';
                    }
                    else {
                        document.getElementById('Div1').style.display = 'none';
                        document.getElementById('Div2').style.display = 'none';
                        document.getElementById('Div3').style.display = 'block';
                    }
                
            }
        </script>
    </body>
</html>
