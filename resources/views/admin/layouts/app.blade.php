<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
    <title>Rapat Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src=" {{ asset('js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert/css/sweetalert.css') }}">
    <script src="{{ asset('sweetalert/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery/css/jquery-ui.css') }}">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <script src="{{ asset('jquery/js/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('jquery/js/jquery-ui.js') }}"></script>
    <!-- <script src="{{ asset('jquery/js/moment-with-locales.js') }}"></script> -->

</head>

<body>
    @include('sweet::alert')
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-primary header-text-light">
            <div class="app-header__logo">
                <div class=""><img src="{{ asset('assets/images/logopoltek.png') }}" alt=""></div>
            </div>

            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-icon btn-icon-only btn header-text-light">
                        <i style="color: white;" class="fa fa-angle-down"></i>
                    </a>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <a href="{{ url('akun-admin') }}" class="dropdown-item">
                            Pengaturan Akun
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                            {{ __('Keluar') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </span>
            </div>

            <div class="app-header__content bg-primary">

                <div class="app-header-left">

                </div>

                <div class="app-header-right ">

                    @auth("admin")
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ auth()->guard('admin')->user()->name }}
                                    </div>
                                </div>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ url('akun-admin') }}" class="dropdown-item">
                                                Pengaturan Akun
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Keluar') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>


        <div class="app-main">

            @include('admin.layouts.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">


                    <!-- content -->
                    @yield('content')


                </div>
            </div>
        </div>
    </div>

    @else
    <ul class="header-menu nav">
        <li class="nav-item">
            <a style="color: white;" class="nav-link" href="{{ url('/admin') }}">{{ __('Beranda') }}</a>
        </li>
    </ul>
    @endauth

    <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>


</body>

</html>