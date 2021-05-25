<!DOCTYPE html>
<html lang="en">
<head>
    <title>Apurva Water Solution</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!--end::Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('front/css/css-bootstrap.css')}}">
    <link rel="stylesheet" href="{{ url('front/css/css-fonts.css')}}">
    <link rel="stylesheet" href="{{ url('front/css/css-style.css')}}">
    
    <link rel="shortcut icon" href="{{url('assets/media/logos/fav.png')}}" />
</head>

<body>
    <div class="page">
        <!-- Page Header-->
        <header class="section page-header">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-minimal" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                    data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
                    data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed"
                    data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
                    data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
                    data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px"
                    data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-main-outer">
                        <div class="rd-navbar-main">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle"
                                    data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                                <!-- RD Navbar Brand--><a class="rd-navbar-brand" href="{{route('front.home')}}"><img
                                        src="{{ url('front/images/logo-default-250x64.png')}}" alt="" width="132"
                                        height="34" srcset="images/logo-default-250x64.png 2x"></a>
                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                                    <!-- RD Navbar Nav-->
                                    <ul class="rd-navbar-nav">
                                        <li class="rd-nav-item {{ Route::is('front.home')  ? 'active' : '' }}"><a class="rd-nav-link" href="{{route('front.home')}}">Home</a>
                                        </li>
                                        <li class="rd-nav-item {{ Route::is('front.about')  ? 'active' : '' }}"><a class="rd-nav-link" href="{{route('front.about')}}">About</a></li>
                                        <li class="rd-nav-item {{ Route::is('front.blog') || Route::is('front.blog_single') ? 'active' : '' }}"><a class="rd-nav-link" href="{{route('front.blog')}}">Blog</a></li>
                                        <li class="rd-nav-item {{ Route::is('front.product')  ? 'active' : '' }}"><a class="rd-nav-link" href="{{route('front.product')}}">Products</a></li>
                                        <li class="rd-nav-item {{ Route::is('front.contact')  ? 'active' : '' }}"><a class="rd-nav-link" href="{{route('front.contact')}}">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- Slider-->