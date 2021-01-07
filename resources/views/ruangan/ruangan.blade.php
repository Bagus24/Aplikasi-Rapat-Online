@extends('layouts.app')

@section('content')

<div class="main-card mb-3 card">
    <div class="card-body">
        @if (Session::has('errortanggal'))
        <script>
            swal("Gagal!", "Mohon lihat agenda kembali!", "error");
        </script>
        @endif
        @if (Session::has('errormulai'))
        <script>
            swal("Gagal!", "Rapat belum dimulai!", "error");
        </script>
        @endif
        @if (Session::has('errorselesai'))
        <script>
            swal("Gagal!", "Rapat sudah selesai!", "error");
        </script>
        @endif
        @if (Session::has('errorpeserta'))
        <script>
            swal("Gagal!", "Anda tidak terdaftar dalam rapat!", "error");
        </script>
        @endif
        <h5 class="card-title">Data Ruangan</h5>
        <div class="float-right">
            <form class="form-inline" action="{{ url('ruangan-rapat/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class=" form-control" type="number" name="cari" placeholder="cari ruangan.." value="{{ old('cari') }}"></input>
                    &nbsp;
                    <button style="height: 38px;" class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
            <br>
        </div>
        <table class="mb-0 table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($ruangan->count() > 0)
                <?php $no = 0; ?>
                @foreach($ruangan as $r)
                <?php $no++; ?>
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $r->kode }}</td>
                    <td>
                        <a class="mb-2 mr-2 btn btn-primary" href="{{ url('/room/join/'.$r->kode) }}">Masuk Ruangan</a>
                    </td>
                </tr>

                @endforeach
                @else
                <tr>
                    <td></td>
                    <td>Tidak ada data</td>
                    <td></td>

                </tr>
                @endif
            </tbody>
        </table>

        <br>
        <div class="float-right">
            <nav class="" aria-label="Page navigation example">
                <ul class="pagination">
                    {{ $ruangan->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection