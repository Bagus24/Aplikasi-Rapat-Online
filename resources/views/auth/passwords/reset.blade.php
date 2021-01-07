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
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                @if (Session::has('status'))
                                <script>
                                    swal("Berhasil!", "Kata sandi telah diubah!", "success");
                                </script>
                                @endif
                                <h5 class="card-title">Atur uang kata sandi</h5>

                                <form class="needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="position-relative row form-group">
                                        <label for="examplePassword" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="examplePassword" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input placeholder="masukan kata sandi.." id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="input-group-append">
                                                    <input id="show" onclick="ShowPassword()" class="btn btn-light" value="Perlihatkan kata sandi"></input>
                                                    <input class="btn btn-light" style="display:none" id="hide" value="Sembunyikan kata sandi" onclick="HidePassword()"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative row form-group">
                                        <label for="examplePassword" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input placeholder="masukan konfirmasi kata sandi.." id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <input id="showConfirm" onclick="ShowPasswordConfirm()" class="btn btn-light" value="Perlihatkan kata sandi"></input>
                                                    <input class="btn btn-light" style="display:none" id="hideConfirm" value="Sembunyikan kata sandi" onclick="HidePasswordConfirm()"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function ShowPassword() {
            if (document.getElementById("password").value != "") {
                document.getElementById("password").type = "text";
                document.getElementById("show").style.display = "none";
                document.getElementById("hide").style.display = "block";
            }
        }

        function HidePassword() {
            if (document.getElementById("password").type == "text") {
                document.getElementById("password").type = "password"
                document.getElementById("show").style.display = "block";
                document.getElementById("hide").style.display = "none";
            }
        }

        function ShowPasswordConfirm() {
            if (document.getElementById("password-confirm").value != "") {
                document.getElementById("password-confirm").type = "text";
                document.getElementById("showConfirm").style.display = "none";
                document.getElementById("hideConfirm").style.display = "block";
            }
        }

        function HidePasswordConfirm() {
            if (document.getElementById("password-confirm").type == "text") {
                document.getElementById("password-confirm").type = "password"
                document.getElementById("showConfirm").style.display = "block";
                document.getElementById("hideConfirm").style.display = "none";
            }
        }
    </script>
    <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/sweetalert.min.js') }}"></script>
    @else
    @endguest
</body>

</html>