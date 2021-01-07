@extends('admin.layouts.app')
@section('content')
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('select2/jquery-3.4.1.js') }}" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="{{ asset('select2/select2.min.js') }}"></script>
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Agenda</h5>
        <br>
        <form class="" method="POST" action="{{ route('agenda.store') }}">
            @csrf

            <div class="position-relative row form-group">
                <label for="jenis" class="col-sm-2 col-form-label">Jenis Rapat</label>
                <div class="col-sm-10">
                    <select name="jenis" id="jenis" class="form-control">
                       <option value="Resmi">Resmi</option>
                       <option value="Tidak Resmi">Tidak Resmi</option>
                       <option value="Penjelasan">Penjelasan</option>
                       <option value="Pemecahan Masalah">Pemecahan Masalah</option>
                       <option value="Perundingan">Perundingan</option>
                       <option value="Terbuka">Terbuka</option>
                       <option value="Tertutup">Tertutup</option>
                    </select>
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="pembahasan" class="col-sm-2 col-form-label">Pembahasan Rapat</label>
                <div class="col-sm-10">
                    <input id="pembahasan" maxlength="100" placeholder="masukan tema pembahasan.." type="text" class="form-control @error('pembahasan') is-invalid @enderror" name="pembahasan" value="{{ old('pembahasan') }}" required>
                    @error('pembahasan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="datepicker" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input id="datepicker" placeholder="masukan tanggal rapat.." type="date" maxlength="10" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" required>
                    @error('tanggal')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="mulai" class="col-sm-2 col-form-label">Waktu Mulai</label>
                <div class="col-sm-10">
                    <input id="mulai" placeholder="masukan waktu mulai rapat.." type="time" class="form-control @error('mulai') is-invalid @enderror" name="mulai" required>
                    @error('mulai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="selesai" class="col-sm-2 col-form-label">Waktu Selesai</label>
                <div class="col-sm-10">
                    <input id="selesai" placeholder="masukan waktu selesai rapat.." type="time" class="form-control @error('selesai') is-invalid @enderror" name="selesai" required>
                    @error('selesai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="kode" class="col-sm-2 col-form-label">Ruangan</label>
                <div class="col-sm-10">
                    <select name="kode" id="ruangan" class="form-control">
                        @foreach($ruangan as $r)
                        <option value="{{ $r->kode }}">{{ $r->kode }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="pimpinan" class="col-sm-2 col-form-label">Pemimpin Rapat</label>
                <div class="col-sm-10">
                    <select name="pimpinan" id="pemimpin" class="form-control">
                        @foreach($peserta as $pes)
                        <option value="{{$pes->nipy}}{{ $pes->nama }}">{{ $pes->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
       
            <div class="position-relative row form-group">
                <label for="peserta" class="col-sm-2 col-form-label">Pilih Peserta</label>
                <div class="col-sm-10">
                    @if ($peserta->count() > 0)
                    <?php $no = 0; ?>
                    @foreach($peserta as $p)
                    <?php $no++; ?>
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" id="exampleCustomCheckbox{{ $no }}" class="custom-control-input" name="peserta[]" value="{{ $p->nipy }}">
                        <label class="custom-control-label" for="exampleCustomCheckbox{{ $no }}">{{ $p->nama }}</label>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </div>
</div>
<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            locale: 'id',
            changeMonth: true,
            changeYear: true,
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ruangan').select2();
    });
    $(document).ready(function() {
        $('#pemimpin').select2();
    });
   
</script>

@endsection