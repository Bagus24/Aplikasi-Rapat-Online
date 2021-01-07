<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rapat Online</title>
	<style type="text/css">
		.ukuran {
			font-size: 12px;
			line-height: 5px;

		}

		.kop {
			font-size: 12px;
			line-height: 4px;
		}

		.poltek {
			font-size: 18px;
			line-height: 5px;
		}

		.websiteemail {
			font-size: 10px;
		}

		.warnamerah {
			color: red;
		}

		.warnabiru {
			color: blue;
		}

		.hr {
			border: 0;
			border-top: 3px double #8c8c8c;
		}

		.logo {
			width: 100px;
			height: 100px;
		}

		.tandatangan {
			font-size: 12px;
			text-align: center;
			position: absolute;
        	right: 0;
        	width: 200px;
		}
	</style>
</head>

<body>
	<div class="kop">
		<center>
			<img height="100" src="{{ asset('kop/poltektegal.png') }}" style="float: left; margin: 0px 0px 0px 0px;" width="100" />
			<p>Yayasan Pendidikan Harapan Bersama</p>
			<p class="poltek"><span class="warnamerah">PoliTekniK </span><span class="warnabiru">Harapan Bersama</span></p>
			<p>Kampus I. Jl. Mataram No.9 Tegal 52142 Telp. 0283-352000 Fax. 0283-353353</p>
			<p>Kampus II. Jl. Dewi Sartika No.71 Tegal 52117 Telp. 0283-350567</p>
			<p class="websiteemail">Website : www.poltektegal.ac.id &nbsp; Email : sekretariat@poltektegal.ac.id</p>
			<hr class="hr">
		</center>
	</div>
	<p class="ukuran" style="text-align: right;">Tegal, {{ $hari }}&nbsp;{{ $bulan }}&nbsp;{{ $tahun }}</p>

	<center>
		<h4 style="text-transform: uppercase;">NOTULA RAPAT ({{ $agenda->pembahasan }})</h4>
	</center>

	<div class="ukuran">
		<p>Jenis Rapat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;{{ $agenda->jenis }}</p>
		<p>Tanggal Rapat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;{{ $hari }}&nbsp;{{ $bulan }}&nbsp;{{ $tahun }}</p>
		<p>Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;Pukul {{ $agenda->mulai }} - {{ $agenda->selesai }} WIB</p>
		<p>Ruangan Rapat&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;{{ $agenda->kode }}</p>
		<p>Pemimpin Rapat &nbsp;: &nbsp;&nbsp;{{ $agenda->pimpinan}}</p>
		<p>Peserta Rapat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>

		@if (count($ambilnama) > 0)
		<?php $no = 0; ?>

		@foreach($ambilnama as $an)
		<?php $no++; ?>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $no }}.&nbsp;&nbsp;{{ $an->nama }} </p>
		@endforeach
		@endif
		<br>
		<u>Hasil Percakapan Rapat</u>
		<br>
		<br>
		<div style="text-align: justify">
			@foreach($message as $m)
			<p>{{ $m->nama }}&nbsp;&nbsp;:&nbsp;&nbsp;"{{ $m->message }}."</p>
			@endforeach
		</div>
	</div>
	<br><br><br>
	<div class="tandatangan">
		<p>Tegal,&nbsp;&nbsp;{{ $hari }}&nbsp;{{ $bulan }}&nbsp;{{ $tahun }}</p>
			<br>
			<br>
			<br>
		<p>{{ $agenda->pimpinan}}</p>	
	</div>
	


</body>

</html>