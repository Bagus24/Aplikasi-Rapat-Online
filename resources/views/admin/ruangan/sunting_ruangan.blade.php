@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Sunting Data Ruangan</h5>
        <br>
        <form class="" method="POST" action="{{ route('ruangan.update', $ruangan->id ) }}">
            @csrf
            @method('PUT')
            

            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Ruangan</label>
                <div class="col-sm-10">
                    <input id="kode" maxlength="12" placeholder="masukan nama ruangan.." type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $ruangan->kode }}" required>
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