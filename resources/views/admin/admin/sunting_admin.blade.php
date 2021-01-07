@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Sunting Data Akun Admin</h5>
        <br>
        <form class="" action="{{ route('akun-admin.update', $admin->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="position-relative row form-group">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input placeholder="masukan nama admin.." pattern="[A-Za-z .,]+" id="nama" maxlength="10" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $admin->name }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="email" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input id="username" placeholder="masukan username.." type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $admin->username }}" required>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Sunting Kata Sandi Admin</h5>
        <br>
        <form class="" action="{{ url('akun-admin/katasandi', $admin->id) }}" method="POST">
            @csrf
           <div class="position-relative row form-group">
                <label for="password" class="col-sm-2 col-form-label">Kata Sandi</label>
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
                <label for="password-confirm" class="col-sm-2 col-form-label">Konfirmasi Kata Sandi</label>
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
@endsection