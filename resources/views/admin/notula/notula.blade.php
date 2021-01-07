@extends('admin.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tabel Data Notula</h5>
        <div class="float-right">
            <form class="form-inline" action="{{ url('notula/cari') }}" method="GET">
                <div class="position-relative form-group">
                    <input class=" form-control" type="text" name="cari" placeholder="cari notula.." value="{{ old('cari') }}"></input>
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
                        <th>Pembahasan</th>
                        <th>Tanggal</th>
                        <th>Ruangan</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($agenda->count() > 0)
                    <?php $no = 0; ?>
                    @foreach($agenda as $a)
                    <?php $no++; ?>
                    <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{ $a->pembahasan }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->kode }}</td>
                        <td><a class="mb-2 mr-2 btn btn-light p-1" target="_blank" href="{{ url('notula-cetak', $a->id) }}">Cetak</a></td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td></td>
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
@endsection