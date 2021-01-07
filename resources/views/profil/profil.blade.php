@extends('layouts.app')

@section('content')

<div class="row">
    @if (Session::has('tambah'))
    <script>
        swal("Berhasil!", "Data telah ditambahkan!", "success");
    </script>
    @endif
    @if (Session::has('sunting'))
    <script>
        swal("Berhasil!", "Data telah diubah!", "success");
    </script>
    @endif
    @if (Session::has('hapus'))
    <script>
        swal("Berhasil!", "Data telah dihapus!", "success");
    </script>
    @endif
    @if (Session::has('foto'))
    <script>
        swal("Berhasil!", "Foto telah diubah!", "success");
    </script>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger fade show">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-4">
        <div class="main-card mb-3 card">
            @if (empty($peserta))
            <img style="width: 400px; height: 400px" src="{{ url('images/kosong.jpg') }}" alt="Card image cap" class=" img-thumbnail img-responsive">
            @else
            <img style="width: 400px; height: 400px" src="{{ url('images/'. $peserta->foto) }}" alt="Card image cap" class=" img-thumbnail img-responsive">
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-11">
                        <h5 class="card-title">Profil</h5>
                    </div>
                    @if (empty($peserta))
                    <a href="#" class="mr-2 btn-icon btn-icon-only btn btn-outline-primary"><i class="pe-7s-note btn-icon-wrapper"> </i></a>
                    @else
                    <a href="{{ route('profil.edit', $peserta->id)}}" class="mr-2 btn-icon btn-icon-only btn btn-outline-primary"><i class="pe-7s-note btn-icon-wrapper"> </i></a>
                    @endif
                </div>

                <div class="form-row">
                    <span class="col-sm-4">Nama</span>
                    <div class="col-sm-6">
                        @if (empty($peserta))
                        <span>: </span><span></span>
                        @else
                        <span>: </span><span>{{ $peserta->nama }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="col-sm-4">Email</span>
                    <div class="col-sm-6">
                        <span>: </span><span>{{ $users->email }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <span class="col-sm-4">NIPY</span>
                    <div class="col-sm-6">
                        <span>: </span><span>{{ $users->nipy }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <span class="col-sm-4">Status</span>
                    <div class="col-sm-6">
                        @if (empty($peserta))
                        <span>: </span><span></span>
                        @else
                        <span>: </span><span>{{ $peserta->status }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="col-sm-4">Jabatan Akademik</span>
                    <div class="col-sm-6">
                        @if (empty($peserta))
                        <span>: </span><span></span>
                        @else
                        <span>: </span><span>{{ $peserta->jabatan }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <span class="col-sm-4">Pendidikan</span>
                    <div class="col-sm-6">
                        @if (empty($peserta))
                        <span>: </span><span></span>
                        @else
                        <span>: </span><span>{{ $peserta->pendidikan }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection