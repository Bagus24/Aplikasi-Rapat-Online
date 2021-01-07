@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Agenda</h5>
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
        @if (Session::has('errorpeserta'))
        <script>
            swal("Gagal!", "Salah satu peserta terdapat pada Rapat lain di waktu yang sama!", "error");
        </script>
        @endif
        @if (Session::has('errortanggal'))
        <script>
            swal("Gagal!", "Tanggal sudah berlalu!", "error");
        </script>
        @endif
        @if (Session::has('errorpimpinan'))
        <script>
            swal("Gagal!", "Pemimpin rapat tidak terdaftar!", "error");
        </script>
        @endif
        @if (Session::has('errorwaktumulai'))
        <script>
            swal("Gagal!", "Waktu mulai sudah berlalu!", "error");
        </script>
        @endif
        @if (Session::has('errorupdate'))
        <script>
            swal("Gagal Ubah!", "Salah satu peserta terdapat pada Rapat lain di waktu yang sama!", "error");
        </script>
        @endif
        @if (Session::has('errorwaktu'))
        <script>
            swal("Gagal!", "Waktu rapat salah!", "error");
        </script>
        @endif
        @if (Session::has('errorwaktuupdate'))
        <script>
            swal("Gagal!", "Waktu rapat salah!", "error");
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
        <a href="{{ route('agenda.create')}}" class="mb-2 mr-2 btn btn-success">
            Tambah Data
        </a>
        <div class="float-right">
            <form class="form-inline" action="{{ url('agenda/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class=" form-control" type="text" name="cari" placeholder="cari agenda.." value="{{ old('cari') }}"></input>
                    &nbsp;
                    <button style="height: 38px;" class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
            <br>
        </div>

        <div class="table-responsive">
            <table width="100%" class="mb-0 table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Rapat</th>
                        <th>Pembahasan Rapat</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Ruangan</th>
                        <th>Pemimpin Rapat</th>
                        <th>Peserta Rapat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($agenda->count() > 0)
                    <?php $no = 0; ?>
                    @foreach($agenda as $a)
                    <?php $no++; ?>
                    <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{ $a->jenis }}</td>
                        <td>{{ $a->pembahasan }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->mulai }}</td>
                        <td>{{ $a->selesai }}</td>
                        <td>{{ $a->kode }}</td>
                        <td>{{ $a->pimpinan }}</td>
                        <td>{{ $a->nama_peserta }}</td>
                        <td>
                            <form id="data-{{ $a->id }}" action="{{ route('agenda.destroy', $a->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="mb-2 mr-2 btn btn-info p-1" href="{{ route('agenda.edit', $a->id)}}">Sunting</a>
                            <button class="mb-2 mr-2 btn btn-danger p-1" onclick="hapusAgenda( {{ $a->id }} )">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td></td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>
                        <td>Tidak ada data</td>

                        <td></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <br>
        <div class="float-right">
            <nav class="" aria-label="Page navigation example">
                <ul class="pagination">
                    {{ $agenda->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    function hapusAgenda(id) {
        swal({
                title: "Yakin hapus data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#data-' + id).submit();
                } else {
                    swal("Data tidak dihapus");
                }
            });
    }
</script>
@endsection