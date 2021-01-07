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
</head>

<body>
    @include('sweet::alert')
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-primary header-text-light">
            <div class="app-header__logo">
                <div class=""><img src="{{ asset('assets/images/logopoltek.png') }}" alt=""></div>
            </div>

            <!-- <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div> -->
            <!-- <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div> -->

            <div class="app-header__content bg-primary">
                <div class="app-header-left">
                    @guest
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Beranda') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>



        <div class="app-main">
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <!-- content -->

                    <div class="container-fluid">

                        <div class="main-card mb-3 col-md-12 card">
                            <div class="card-body">
                               
                                @if (Session::has('status'))
                                <script>
                                    swal("Berhasil!", "Silahkan cek email anda!", "success");
                                </script>
                                @endif
                                <h5 class="card-title">Atur uang kata sandi</h5>
                                <br>
                                <form class="needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="position-relative row form-group">
                                        <label for="examplePassword" class="col-sm-2 col-form-label">Masukan Email</label>
                                        <div class="col-sm-10">
                                            <input id="email" type="email" class=" mb-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" type="submit">Kirim link</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/sweetalert.min.js') }}"></script>
    @else
    @endguest
</body>

</html>