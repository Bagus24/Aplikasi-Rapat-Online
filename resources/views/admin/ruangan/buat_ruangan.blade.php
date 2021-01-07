@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Ruangan</h5>
        <br>
        <form class="" method="POST" action="{{ route('ruangan.store') }}">
            @csrf
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Ruangan</label>
                <div class="col-sm-10">
                    <input placeholder="masukan nama ruangan.." maxlength="12" id="ruangan" type="text" class="form-control @error('ruangan') is-invalid @enderror" name="kode" value="{{ old('kode') }}" required autofocus>
                    <small class="form-text text-muted">*isikan tanggal dan waktu mulai rapat. contoh 010120200800</small>
                    @error('kode')
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