@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Peserta</h5>
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
        @if (Session::has('error'))
        <script>
            swal("Gagal!", "Salah satu peserta terdapat pada Rapat lain di waktu yang sama!", "error");
        </script>
        @endif
        @if (Session::has('errorupdate'))
        <script>
            swal("Gagal Ubah!", "Salah satu peserta terdapat pada Rapat lain di waktu yang sama!", "error");
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
        <a href="{{ route('peserta.create')}}" class="mb-2 mr-2 btn btn-success">
            Tambah Data
        </a>
        <div class="float-right">
            <form class="form-inline" action="{{ url('peserta/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class=" form-control" type="text" name="cari" placeholder="cari peserta.." value="{{ old('cari') }}"></input>
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
                        <th>NIPY</th>
                        <th>Nama Peserta</th>
                        <th>Status</th>
                        <th>Jabatan Akademik</th>
                        <th>Pendidikan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($peserta->count() > 0)
                    <?php $no = 0; ?>
                    @foreach($peserta as $p)
                    <?php $no++; ?>
                    <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{$p->nipy}}</td>
                        <td>{{$p->nama}}</td>
                        <td>{{$p->status}}</td>
                        <td>{{$p->jabatan}}</td>
                        <td>{{$p->pendidikan}}</td>
                        <td><img style="width: 50px; height: 50px" src="{{ url('/images/'. $p->foto) }}" alt=""></td>
                        <td>
                            <form id="data-{{ $p->id }}" action="{{ route('peserta.destroy', $p->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="mb-2 mr-2 btn btn-info p-1" href="{{ route('peserta.edit', $p->id)}}">Sunting</a>
                            <button class="mb-2 mr-2 btn btn-danger p-1" onclick="hapusPeserta( {{ $p->id }} )">Hapus</button>
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
                    {{ $peserta->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    function hapusPeserta(id) {
        swal({
                title: "Yakin hapus data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // document.getElementById("delete-user").click();
                    $('#data-' + id).submit();
                } else {
                    swal("Data tidak dihapus");
                }
            });
    }
</script>
@endsection