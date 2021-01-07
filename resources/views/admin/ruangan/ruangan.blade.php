@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Ruangan</h5>
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

        @if ($errors->any())
        <div class="alert alert-danger fade show">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <a href="{{ route('ruangan.create') }}" class="mb-2 mr-2 btn btn-success">
            Tambah Data
        </a>
        <div class="float-right">
            <form class="form-inline" action="{{ url('ruangan/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class=" form-control" type="text" name="cari" placeholder="cari ruangan.." value="{{ old('cari') }}"></input>
                    &nbsp;
                    <button style="height: 38px;" class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
            <br>
        </div>
        <div class="table-responsive">
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
                        <td scope="row">{{ $no }}</td>
                        <td>{{ $r->kode }}</td>
                        <td>
                            <form id="data-{{ $r->id }}" action="{{ route('ruangan.destroy', $r->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a class="mb-2 mr-2 btn btn-info p-1" href="{{ route('ruangan.edit', $r->id)}}">Sunting</a>
                            <button class="mb-2 mr-2 btn btn-danger p-1" onclick="hapusRuangan( {{ $r->id }} )">Hapus</button>
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
        </div>

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

<script>
    function hapusRuangan(id) {
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