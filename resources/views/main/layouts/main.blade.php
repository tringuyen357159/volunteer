<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>@yield('title')</title>

        <!--    Google Fonts-->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!--Fontawesom-->
        <link rel="stylesheet" href="{{asset('home/css/font-awesome.min.css')}}">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <!--Animated CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('home/css/animate.min.css')}}">

        <!-- Bootstrap -->
        <link href="{{asset('client/css/bootstrap.min.css')}}" rel="stylesheet">

        <!--Bootstrap Carousel-->
        <link type="text/css" rel="stylesheet" href="{{asset('client/css/carousel.css')}}" />

        <link rel="stylesheet" href="{{asset('client/css/isotope/style.css')}}">
        <!--Main Stylesheet-->
        <link href="{{asset('client/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('home/css/style.css')}}" rel="stylesheet">
        <!--Responsive Framework-->
        <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet">
        <!--Welcome Css-->
        <link href="{{asset('home/css/welcome.css')}}" rel="stylesheet">
        <link href="{{asset('home/css/donate.css')}}" rel="stylesheet">
        <link href="{{asset('home/css/detail_event.css')}}" rel="stylesheet">
        <!--CSS Validation-->
        <link href="{{asset('home/css/userdropdown.css')}}" rel="stylesheet">
        <link href="{{asset('client/css/validator.css')}}" rel="stylesheet">
        <link href="{{asset('client/css/login.css')}}" rel="stylesheet">
        <link href="{{asset('client/css/Profile.css')}}" rel="stylesheet">
        <link href="{{asset('client/css/managerevent.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @toastr_css
    </head>
    <body data-spy="scroll" data-target="#header">

        <!--Start Hedaer Section-->
        @include('main.layouts.menu')
        <!--End of Hedaer Section-->

        @yield('body')



        <!--Start of footer-->
        @include('main.layouts.footer')
        <!--End of footer-->



        <!--Scroll to top-->
        <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
        <!--End of Scroll to top-->


        <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>-->
        <script src="{{asset('home/js/jquery-1.12.3.min.js')}}"></script>


        <!--Counter UP-->
        <script src="{{asset('home/js/jquery.counterup.min.js')}}"></script>
        <!--Counter UP Waypoint-->
        <script src="{{asset('home/js/waypoints.min.js')}}"></script>
        <script>
            //for counter up
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        </script>
        <!--Isotope-->
        <script src="{{asset('home/js/isotope/min/scripts-min.js')}}"></script>
        <script src="{{asset('home/js/isotope/cells-by-row.js')}}"></script>
        <script src="{{asset('home/js/isotope/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('home/js/isotope/packery-mode.pkgd.min.js')}}"></script>
        <script src="{{asset('home/js/isotope/scripts.js')}}"></script>


        <!--Back To Top-->
        <script src="{{asset('home/js/backtotop.js')}}"></script>
        <script src="{{asset('home/js/userdropdown.js')}}"></script>



        <!--JQuery Click to Scroll down with Menu-->
        <script src="{{asset('home/js/jquery.localScroll.min.js')}}"></script>
        <script src="{{asset('home/js/jquery.scrollTo.min.js')}}"></script>
        <!--WOW With Animation-->
        <script src="{{asset('home/js/wow.min.js')}}"></script>
        <!--WOW Activated-->
        <script>
            new WOW().init();
        </script>


        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('home/js/bootstrap.min.js')}}"></script>
        <!-- Custom JavaScript-->
        <script src="{{asset('home/js/main.js')}}"></script>
        <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
        <!-- Custom JavaScript-->
        <script src="{{asset('client/js/main.js')}}"></script>
        <script src="{{asset('js/validatorClient.js')}}"></script>
        <!-- AOS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
        @jquery
        @toastr_js
        @toastr_render
        @yield('jsblock')
    </body>
</html>
