<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rapat Online</title>
	<link href="{{ asset('main.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
	<style type="text/css">
		.kertas {
			display: block;
			margin: auto;
			width: 60%;
			height: 100%;
		}

		.ukuran {
			font-size: 14px;
			line-height: 20px;

		}

		.kop {
			font-size: 16px;
			line-height: 4px;
		}

		.poltek {
			font-size: 24px;
			line-height: 6px;
			padding-bottom: 5px;
		}

		.websiteemail {
			font-size: 12px;
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

	
	</style>
</head>

<body style="background-color: #f1f4f6;">
	<!-- <div class="app-container app-theme-white body-tabs-shadow"> -->
	<div class="app-main">
		<div class="app-main__outer">
			<div class="app-main__inner">
				<div class="main-card mb-3 card kertas">
					<div style="padding: 50px;" class="card-body">
						<div class="kop">
							<center>
							<img style="float: left;" src="{{ $message->embed(public_path() . '/kop/poltektegal.png') }}" width="120px" height="120px" />
								<img height="100" src="{{ asset('kop/poltektegal.png') }}" style="float: left; margin: 0px 0px 0px 0px;" width="100" />
								<p>Yayasan Pendidikan Harapan Bersama</p>
								<p class="poltek"><span class="warnamerah">PoliTekniK </span><span class="warnabiru">Harapan Bersama</span></p>
								<p>Kampus I. Jl. Mataram No.9 Tegal 52142 Telp. 0283-352000 Fax. 0283-353353</p>
								<p>Kampus II. Jl. Dewi Sartika No.71 Tegal 52117 Telp. 0283-350567</p>
								<p class="websiteemail">Website : www.poltektegal.ac.id &nbsp; Email : sekretariat@poltektegal.ac.id</p>
								<br>
								<hr class="hr">
							</center>
						</div>
						<br>
						<div class="ukuran">
							<p style="text-align: right;">Tegal, 01&nbsp;Januari&nbsp;2012</p>
							<br>
							<div class="form-row">
								<span class="col-md-1">Hal</span>
								<div class="col-sm-6">
									<span>: </span><span>Undangan Rapat</span>
								</div>
							</div>

							<div class="form-row">
								<span class="col-md-9"></span>
								<div class="col-md-3">
									<span>Yth. </span><span>Nama Peserta</span>
								</div>
								<span class="col-md-9"></span>
								<div class="col-md-3">
									<span>Jabatan Akademik</span>
								</div>
							</div>

							<br><br><br><br>
							<span>Dengan Hormat, </span>
							<br>
							<span>Sehubungan dengan akan diadakanya rapat (pembahasan rapat), kami mengharapkan keikutsertaan Saudara pada :</span>
							<br>
							<br>
							<div class="form-row">
								<span class="col-md-2">Tanggal</span>
								<div class="col-sm-6">
									<span>: </span><span>tanggal</span>
								</div>
							</div>
							<div class="form-row">
								<span class="col-md-2">Waktu</span>
								<div class="col-sm-6">
									<span>: </span><span>waktu</span>
								</div>
							</div>
							<div class="form-row">
								<span class="col-md-2">Ruangan</span>
								<div class="col-sm-6">
									<span>: </span><span>ruangan</span>
								</div>
							</div>


							<br>
							<span>Kami mohon keikutsertaan Saudara tepat pada waktunya. Atas perhatianya kami mengucapkan terima kasih.</span>
							<br>
							<br>
							<br><br><br><br><br>
							<div class="form-row">
								<span class="col-md-9"></span>
								<div class="col-md-3">
									<span>Tegal, 01 Januari 2012 </span>
								</div>
							</div>
							<br>
							<br>
							<br>
							<br>
							<div class="form-row">
								<span class="col-md-9"></span>
								<div class="col-md-3">
									<span>nama pemimpin rapat</span>
								</div>
							</div>




						</div>


					</div>
				</div>
			</div>
		</div>
		<!-- </div> -->
</body>

</html>