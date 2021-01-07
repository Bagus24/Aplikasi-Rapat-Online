<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
    <title>Rapat Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet"></head>

    <style type="text/css">
        .bg-utama{
        background-size: cover;
        background-position: center;
        height: 100%;
        }
    </style>
<body background="{{ asset('assets/images/e-meeting.jpg') }}" class="bg-utama">

<div class="app-container body-tabs-shadow">
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
                            
                            @if (Route::has('login'))
                                @auth
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        Anda sudah login. silahkan klik <a href="{{ url('/home') }}">Masuk</a>
                                    </div>
                                @else  
                            
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="col-sm-12">
                                <div class="divider"></div>   
                                    <div class="position-relative form-group">
                                        <label for="examplenipy" class="col-sm-4 col-form-label">NIPY</label>
                                        <div class="col-md-12">
                                            <input id="nipy" type="text" class="form-control @error('nipy') is-invalid @enderror" name="nipy" value="{{ old('nipy') }}" required autocomplete="nipy" autofocus>
                                            @error('nipy')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="examplenipy" class="col-sm-6 col-form-label">Kata sandi</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="position-relative form-check">
                                        <input name="remember" {{ old('remember') ? 'checked' : '' }} id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Biarkan saya tetap masuk</label>
                                    </div> -->
                                    <div class="divider"></div>
                                    <div class="col-md-12">
                                    
                                        <div class="float-right">
                                        @if (Route::has('password.request'))
                                                        <div class="ml-auto"><a class="btn-lg btn btn-link" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                                                    @endif
                                            <button type="submit" class="btn btn-primary btn-lg mb-2 ">Masuk</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if (Route::has('register'))
                                            @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>

</body>
</html>

