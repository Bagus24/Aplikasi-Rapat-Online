@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Akun Peserta</h5>
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
        <a href="{{ route('akun-peserta.create')}}" class="mb-2 mr-2 btn btn-success">
            Tambah Data
        </a>
        <div class="float-right">
            <form class="form-inline" action="{{ url('akun-peserta/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class="form-control" type="text" name="cari" placeholder="cari akun peserta.." value="{{ old('cari') }}"></input>
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
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                    <?php $no = 0; ?>
                    @foreach($users as $u)
                    <?php $no++; ?>
                    <tr>
                        <td scope="row">{{ $no }}</td>
                        <td>{{$u->nipy}}</td>
                        <td>{{$u->email}}</td>
                        <td>
                            <form id="data-{{ $u->id }}" action="{{ route('akun-peserta.destroy', $u->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="mb-2 mr-2 btn btn-info p-1" href="{{ route('akun-peserta.edit', $u->id)}}">Sunting</a>
                            <button class="mb-2 mr-2 btn btn-danger p-1" onclick="hapusAkun( {{ $u->id }} )">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td></td>
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
                    {{ $users->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    function hapusAkun(id) {
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