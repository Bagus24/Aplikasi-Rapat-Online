@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h5 class="card-title">Halaman Utama</h5>
        Selamat datang di Aplikasi Rapat Online PoliTeknik Harapan Bersama
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
        @if (Session::has('reset'))
        <script>
            swal("Berhasil!", "Kata sandi telah di atur ulang!", "success");
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
    </div>
</div>
@endsection