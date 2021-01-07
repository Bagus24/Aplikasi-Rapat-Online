@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Sunting Data Peserta</h5>
        <br>
        <form class="" method="POST" action="{{ route('peserta.update', $peserta->id) }}">
            @csrf
            @method('PUT')
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">NIPY</label>
                <div class="col-sm-10">
                    <input name="nipy" id="nipy" disabled class="form-control @error('nipy') is-invalid @enderror" value="{{ $peserta->nipy }}" required>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input maxlength="40" placeholder="masukan nama lengkap dengan gelar.." id="nama" type="text" pattern="[A-Za-z ,.]+" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $peserta->nama }}" required autofocus>
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input maxlength="40" placeholder="masukan status peserta.." id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ $peserta->status }}" required>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Jabatan Akademik</label>
                <div class="col-sm-10">
                    <input maxlength="40" placeholder="masukan jabatan peserta.." id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ $peserta->jabatan }}" required>
                    @error('jabatan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleText" class="col-sm-2 col-form-label">Pendidikan</label>
                <div class="col-sm-10">
                    <textarea name="pendidikan" id="pendidikan" class="form-control" class="form-control @error('pendidikan') is-invalid @enderror" required>{{ $peserta->pendidikan }}</textarea>
                    @error('pendidikan')
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

<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Sunting Foto Peserta</h5>
        <br>
        <form class="" method="POST" action="{{ url('peserta/update-foto', $peserta->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="position-relative row form-group">
                <label for="exampleFile" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input value="{{ $peserta->foto }}" name="foto" id="file" type="file" class="form-control-file" accept="image/jpeg,image/jpg,image/png," class="form-control @error('foto') is-invalid @enderror" style="display: none;" required>
                    <button type="button" id="pilih" class="btn btn-primary">Pilih Foto</button>
                    @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <small class="form-text text-muted">
                        Masukan foto peserta. format foto berupa file .jpeg, .jpg, dan .png
                    </small>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleFile" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <img style="width: 400px; height: 400px" id="gambar" src="{{ url('images/'. $peserta->foto) }}" alt="" class=" img-thumbnail img-responsive">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var tm_pilih = document.getElementById('pilih');
    var file = document.getElementById('file');
    tm_pilih.addEventListener('click', function() {
        file.click();
    })
    file.addEventListener('change', function() {
        gambar(this);
    })

    function gambar(a) {
        if (a.files && a.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('gambar').src = e.target.result;
            }
            reader.readAsDataURL(a.files[0]);
        }

    }
</script>
@endsection