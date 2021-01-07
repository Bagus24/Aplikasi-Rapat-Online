<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
    <title>Rapat Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <script type="text/javascript" src=" {{ asset('js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert/css/sweetalert.css') }}">
    <script src="{{ asset('sweetalert/js/sweetalert.min.js') }}"></script>
</head>

<body>
    @include('sweet::alert')
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="d-flex h-100 justify-content-center align-items-center">
                <div class="mx-auto app-login-box col-md-4">
                    <div class="modal-dialog w-100 mx-auto">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="h5 modal-title text-center">
                                    <div class="app-logo" align="center">
                                        <img src="{{asset ('assets/images/poltek.png')}}" float="center">
                                    </div>
                                    <h4 class="mt-2">
                                        <span>Aplikasi Rapat Online PoliTeknik Harapan Bersama</span>
                                    </h4>
                                </div>

                                @auth("admin")
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    Anda sudah login. silahkan klik <a href="{{ url('home/admin') }}">Masuk</a>
                                </div>
                                @else
                                @if (Session::has('error'))
                                <script>
                                    swal("Gagal!", "Username atau katasandi salah!", "error");
                                </script>
                                @endif
                                <form method="POST" action="{{ url('login/admin') }}">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="divider"></div>
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="col-sm-4 col-form-label">Username</label>
                                            <div class="col-md-12">
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <label for="exampleEmail" class="col-sm-6 col-form-label">Kata sandi</label>
                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="col-md-12">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-primary btn-lg mb-2 ">Masuk</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>

</body>

</html>