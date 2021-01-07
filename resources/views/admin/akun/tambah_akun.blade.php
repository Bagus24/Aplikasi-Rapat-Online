@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Akun Peserta</h5>
        <br>
        <form class="" method="POST" action="{{ route('akun-peserta.store') }}">
            @csrf
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">NIPY</label>
                <div class="col-sm-10">
                    <input placeholder="masukan NIPY peserta.." pattern="[0-9.]+" id="nipy" maxlength="10" type="text" class="form-control @error('nipy') is-invalid @enderror" name="nipy" value="{{ old('nipy') }}" required autofocus>
                    @error('nipy')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input id="email" maxlength="50" placeholder="masukan email peserta.." type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection