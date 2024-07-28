<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ShopMaster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
    <meta name="keywords"
        content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="gettemplates.co" />

    <!--
 //////////////////////////////////////////////////////

 FREE HTML5 TEMPLATE
 DESIGNED & DEVELOPED by FreeHTML5.co
  
 Website: 		http://freehtml5.co/
 Email: 			info@freehtml5.co
 Twitter: 		http://twitter.com/fh5co
 Facebook: 		https://www.facebook.com/fh5co

 //////////////////////////////////////////////////////
 -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet"> -->

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('css\client\css\animate.css') }} ">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href=" {{ asset('css\client\css\icomoon.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href=" {{ asset('css\client\css\bootstrap.css') }}">

    <!-- Flexslider  -->
    <link rel="stylesheet" href=" {{ asset('css\client\css\flexslider.css') }}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href=" {{ asset('css\client\css\owl.carousel.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('css\client\css\owl.theme.default.min.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href=" {{ asset('css\client\css\style.css') }}">

    <!-- Modernizr JS -->
    <script src=" {{ asset('css\client\js\modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
 <script src="js/respond.min.js"></script>
 <![endif]-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
        rel="stylesheet">

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.socket.io/4.7.5/socket.io.min.js" integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.16.1/echo.js" integrity="sha512-wGqDposamaADDdR/lXykxN/FS3rEgrbA7s0F5f8hgQkHbHc/2rDfAA609BjgzFgqbl2D4Drbnxyr5kR2vKxBCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.24/vue.cjs.js" integrity="sha512-8nzM0yEq0UxlayN3MGBCL7/7Z4/oQa/3htLVQYEIn43rHSqT2DTneF6jOdyuTCJdqMVhx40EnB6AhRgqViOZ0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <link rel="stylesheet" href="{{ asset('css\client\chatbox.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css\admin\show_img_in_input.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css\client\css\hoverDropdown.css') }}"> --}}



</head>

<body class="visible " style="position: unset">
    <div class="fh5co-loader"></div>
    <div id="page">
        @include('Fontend.layout.header')
        @yield('content')

        @if (Auth::check())
            @include('Fontend.layout.chatbox')
        @endif
      

    </div>




    <script src=" {{ asset('css\client\js\jquery.min.js') }}"></script>
    <!-- jQuery Easing -->
    <script src=" {{ asset('css\client\js\jquery.easing.1.3.js') }}"></script>
    <!-- Bootstrap -->
    <script src=" {{ asset('css\client\js\bootstrap.min.js') }}"></script>
    <!-- Waypoints -->
    <script src=" {{ asset('css\client\js\jquery.waypoints.min.js') }}"></script>
    <!-- Carousel -->
    <script src=" {{ asset('css\client\js\owl.carousel.min.js') }}"></script>
    <!-- countTo -->
    <script src=" {{ asset('css\client\js\jquery.countTo.js') }}"></script>
    <!-- Flexslider -->
    <script src=" {{ asset('css\client\js\jquery.flexslider-min.js') }}"></script>
    <!-- Main -->
    <script src=" {{ asset('css\client\js\main.js') }}"></script>

</body>

</html>
