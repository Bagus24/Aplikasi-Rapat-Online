<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" type="image/png">
    <title>Rapat Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src=" {{ asset('js/Chart.bundle.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/utils.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/app.js') }}"></script>
</head>

<body style="background-color: #f1f4f6;">
    <div style="width: 97%;" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-primary header-text-light">
            <div class="app-header__logo">
                <div class=""><img src="{{ asset('assets/images/logopoltek.png') }}" alt=""></div>
            </div>

            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">

                <div class="btn-group">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow p-1 btn btn-warning btn-sm">
                        <i data-count="0" class="fa text-white pe-7s-bell pr-1 pl-1"></i>
                        <span class="badge badge-pill badge-danger">{{ $count }}</span>
                    </a>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        @foreach ($notifikasi as $notif)
                        <a href="{{ url('agenda-rapat') }}" class="dropdown-item">
                            {{ $notif->pesan }}
                            <br>
                            di tanggal {{ $notif->tanggal }}
                        </a>

                        @endforeach
                        <div tabindex="-1" class="dropdown-divider"></div>
                        <form action="{{ route('notifikasi.update', Auth::user()->nipy ) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="lama">
                            <button type="submit" class="dropdown-item">tandai sudah dibaca</button>
                        </form>

                    </div>
                </div>

                &nbsp;
                <span>
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-icon btn-icon-only btn header-text-light">
                        <i style="color: white;" class="fa fa-angle-down"></i>
                    </a>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                        <a href="{{ url('akun') }}" class="dropdown-item">
                            Pengaturan Akun
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                            {{ __('Keluar') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </span>

            </div>

            <div class="app-header__content bg-primary">
                <div class="app-header-left">
                    @guest
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Beranda') }}</a>
                        </li>
                    </ul>

                    @else
                </div>


                <div class="app-header-right ">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow p-1 btn btn-warning btn-sm">
                                            <i data-count="0" class="fa text-white pe-7s-bell pr-1 pl-1"></i>
                                            <span class="badge badge-pill badge-danger">{{ $count }}</span>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            @foreach ($notifikasi as $notif)
                                            <a href="{{ url('agenda-rapat') }}" class="dropdown-item">
                                                {{ $notif->pesan }}
                                                <br>
                                                di tanggal {{ $notif->tanggal }}
                                            </a>

                                            @endforeach
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <form action="{{ route('laporan-perbulan.update', Auth::user()->nipy ) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="lama">
                                                <button type="submit" class="dropdown-item">tandai sudah dibaca</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-subheading">
                                        {{ Auth::user()->nama }}
                                    </div>
                                </div>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">

                                            <a href="{{ url('akun') }}" class="dropdown-item">
                                                Pengaturan Akun
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Keluar') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="app-main">

            @include('layouts.sidebar')

            <div class="app-main__outer">
                <div class="app-main__inner">


                    <!-- content -->
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Unduh Data Laporan</h5>
                            <div class="col">

                                <form class="form" action="{{ url('carilaporanperbulan') }}" method="GET">
                                    <div class="position-relative row form-group">
                                        <div class="col-md-5">

                                            <select name="bulan" id="bulan" class="form-control">
                                                <option value="bulan">-- pilih bulan --</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="jenis" id="jenis" class="form-control">
                                                <option value="jenis">-- pilih jenis rapat --</option>
                                                <option value="Resmi">Resmi</option>
                                                <option value="Tidak Resmi">Tidak Resmi</option>
                                                <option value="Penjelasan">Penjelasan</option>
                                                <option value="Pemecahan Masalah">Pemecahan Masalah</option>
                                                <option value="Perundingan">Perundingan</option>
                                                <option value="Terbuka">Terbuka</option>
                                                <option value="Tertutup">Tertutup</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <button style="float: right;height: 38px;" class="btn btn-primary" type="submit">Unduh</button>

                                        </div>


                                    </div>



                                </form>

                            </div>

                        </div>
                    </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Grafik Laporan Perbulan</h5>
                            <div class="col">
                                <div class="float-right">
                                    <form class="form-inline" action="{{ url('laporanperbulan/cari') }}" method="GET">
                                        <div class="position-relative form-group">
                                            <input class="form-control" type="number" name="cari" placeholder="masukan tahun.." value="{{ old('cari') }}"></input>
                                            &nbsp;
                                            <button style="height: 38px;float: right;" class="btn btn-primary" type="submit">Tampil</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <div class="float-right">
                                <div class="mb-2 mr-2 btn-group">
                                    <button class="btn btn-primary">Unduh</button>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-primary"><span class="sr-only">Toggle Dropdown</span></button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <button type="button" tabindex="0" class="dropdown-item"> .CSV</button>
                                        <button type="button" tabindex="0" class="dropdown-item"> .Doc</button>

                                    </div>
                                </div>
                            </div> -->


                            <canvas id="canvas"></canvas>


                            <!-- <button id="randomizeData">Randomize Data</button>
                            <button id="addDataset">Add Dataset</button>
                            <button id="removeDataset">Remove Dataset</button>
                            <button id="addData">Add Data</button>
                            <button id="removeData">Remove Data</button> -->
                            <script>
                                var MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                    'September', 'Oktober', 'November', 'Desember'
                                ];

                                var randomScalingFactor = function() {
                                    return Math.round(Math.random() * 100);
                                };

                                var config = {
                                    type: 'bar',
                                    data: {
                                        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                                            'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                        ],
                                        datasets: [{
                                                label: 'Rapat Resmi',
                                                backgroundColor: window.chartColors.red,
                                                borderColor: window.chartColors.red,
                                                data: [
                                                    '<?php echo $januariresmi; ?>',
                                                    '<?php echo $februariresmi; ?>',
                                                    '<?php echo $maretresmi; ?>',
                                                    '<?php echo $aprilresmi; ?>',
                                                    '<?php echo $meiresmi; ?>',
                                                    '<?php echo $juniresmi; ?>',
                                                    '<?php echo $juliresmi; ?>',
                                                    '<?php echo $agustusresmi; ?>',
                                                    '<?php echo $septemberresmi; ?>',
                                                    '<?php echo $oktoberresmi; ?>',
                                                    '<?php echo $novemberresmi; ?>',
                                                    '<?php echo $desemberresmi; ?>',

                                                ],
                                                fill: false,
                                            }, {
                                                label: 'Rapat Tidak Resmi',
                                                fill: false,
                                                backgroundColor: window.chartColors.blue,
                                                borderColor: window.chartColors.blue,
                                                data: [
                                                    '<?php echo $januaritidakresmi; ?>',
                                                    '<?php echo $februaritidakresmi; ?>',
                                                    '<?php echo $marettidakresmi; ?>',
                                                    '<?php echo $apriltidakresmi; ?>',
                                                    '<?php echo $meitidakresmi; ?>',
                                                    '<?php echo $junitidakresmi; ?>',
                                                    '<?php echo $julitidakresmi; ?>',
                                                    '<?php echo $agustustidakresmi; ?>',
                                                    '<?php echo $septembertidakresmi; ?>',
                                                    '<?php echo $oktobertidakresmi; ?>',
                                                    '<?php echo $novembertidakresmi; ?>',
                                                    '<?php echo $desembertidakresmi; ?>',
                                                ],
                                            }, {
                                                label: 'Rapat Penjelasan',
                                                fill: false,
                                                backgroundColor: window.chartColors.yellow,
                                                borderColor: window.chartColors.yellow,
                                                data: [
                                                    '<?php echo $januaripenjelasan; ?>',
                                                    '<?php echo $februaripenjelasan; ?>',
                                                    '<?php echo $maretpenjelasan; ?>',
                                                    '<?php echo $aprilpenjelasan; ?>',
                                                    '<?php echo $meipenjelasan; ?>',
                                                    '<?php echo $junipenjelasan; ?>',
                                                    '<?php echo $julipenjelasan; ?>',
                                                    '<?php echo $agustuspenjelasan; ?>',
                                                    '<?php echo $septemberpenjelasan; ?>',
                                                    '<?php echo $oktoberpenjelasan; ?>',
                                                    '<?php echo $novemberpenjelasan; ?>',
                                                    '<?php echo $desemberpenjelasan; ?>',
                                                ],
                                            }, {
                                                label: 'Rapat Pemecahan Masalah',
                                                fill: false,
                                                backgroundColor: window.chartColors.green,
                                                borderColor: window.chartColors.green,
                                                data: [
                                                    '<?php echo $januaripm; ?>',
                                                    '<?php echo $februaripm; ?>',
                                                    '<?php echo $maretpm; ?>',
                                                    '<?php echo $aprilpm; ?>',
                                                    '<?php echo $meipm; ?>',
                                                    '<?php echo $junipm; ?>',
                                                    '<?php echo $julipm; ?>',
                                                    '<?php echo $agustuspm; ?>',
                                                    '<?php echo $septemberpm; ?>',
                                                    '<?php echo $oktoberpm; ?>',
                                                    '<?php echo $novemberpm; ?>',
                                                    '<?php echo $desemberpm; ?>',
                                                ],
                                            }, {
                                                label: 'Rapat Perundingan',
                                                fill: false,
                                                backgroundColor: window.chartColors.orange,
                                                borderColor: window.chartColors.orange,
                                                data: [
                                                    '<?php echo $januariperundingan; ?>',
                                                    '<?php echo $februariperundingan; ?>',
                                                    '<?php echo $maretperundingan; ?>',
                                                    '<?php echo $aprilperundingan; ?>',
                                                    '<?php echo $meiperundingan; ?>',
                                                    '<?php echo $juniperundingan; ?>',
                                                    '<?php echo $juliperundingan; ?>',
                                                    '<?php echo $agustusperundingan; ?>',
                                                    '<?php echo $septemberperundingan; ?>',
                                                    '<?php echo $oktoberperundingan; ?>',
                                                    '<?php echo $novemberperundingan; ?>',
                                                    '<?php echo $desemberperundingan; ?>',
                                                ],
                                            }, {
                                                label: 'Rapat Terbuka',
                                                fill: false,
                                                backgroundColor: window.chartColors.purple,
                                                borderColor: window.chartColors.purple,
                                                data: [
                                                    '<?php echo $januariterbuka; ?>',
                                                    '<?php echo $februariterbuka; ?>',
                                                    '<?php echo $maretterbuka; ?>',
                                                    '<?php echo $aprilterbuka; ?>',
                                                    '<?php echo $meiterbuka; ?>',
                                                    '<?php echo $juniterbuka; ?>',
                                                    '<?php echo $juliterbuka; ?>',
                                                    '<?php echo $agustusterbuka; ?>',
                                                    '<?php echo $septemberterbuka; ?>',
                                                    '<?php echo $oktoberterbuka; ?>',
                                                    '<?php echo $novemberterbuka; ?>',
                                                    '<?php echo $desemberterbuka; ?>',
                                                ],
                                            }, {
                                                label: 'Rapat Tertutup',
                                                fill: false,
                                                backgroundColor: window.chartColors.grey,
                                                borderColor: window.chartColors.grey,
                                                data: [
                                                    '<?php echo $januaritertutup; ?>',
                                                    '<?php echo $februaritertutup; ?>',
                                                    '<?php echo $marettertutup; ?>',
                                                    '<?php echo $apriltertutup; ?>',
                                                    '<?php echo $meitertutup; ?>',
                                                    '<?php echo $junitertutup; ?>',
                                                    '<?php echo $julitertutup; ?>',
                                                    '<?php echo $agustustertutup; ?>',
                                                    '<?php echo $septembertertutup; ?>',
                                                    '<?php echo $oktobertertutup; ?>',
                                                    '<?php echo $novembertertutup; ?>',
                                                    '<?php echo $desembertertutup; ?>',
                                                ],
                                            },


                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                            text: 'Grafik Jenis Rapat'
                                        },
                                        tooltips: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        hover: {
                                            mode: 'nearest',
                                            intersect: true
                                        },
                                        scales: {
                                            xAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: ''
                                                }
                                            }],
                                            yAxes: [{
                                                display: true,
                                                scaleLabel: {
                                                    display: true,
                                                    labelString: 'Jumlah rapat'
                                                },
                                                ticks: {
                                                    min: 0,
                                                    max: 20,

                                                    // forces step size to be 5 units
                                                    stepSize: 5
                                                }
                                            }]
                                        }
                                    }
                                };

                                window.onload = function() {
                                    var ctx = document.getElementById('canvas').getContext('2d');
                                    window.myLine = new Chart(ctx, config);
                                };

                                document.getElementById('randomizeData').addEventListener('click', function() {
                                    config.data.datasets.forEach(function(dataset) {
                                        dataset.data = dataset.data.map(function() {
                                            return randomScalingFactor();
                                        });
                                    });

                                    window.myLine.update();
                                });

                                var colorNames = Object.keys(window.chartColors);
                                document.getElementById('addDataset').addEventListener('click', function() {
                                    var colorName = colorNames[config.data.datasets.length % colorNames.length];
                                    var newColor = window.chartColors[colorName];
                                    var newDataset = {
                                        label: 'Dataset ' + config.data.datasets.length,
                                        backgroundColor: newColor,
                                        borderColor: newColor,
                                        data: [],
                                        fill: false
                                    };

                                    for (var index = 0; index < config.data.labels.length; ++index) {
                                        newDataset.data.push(randomScalingFactor());
                                    }

                                    config.data.datasets.push(newDataset);
                                    window.myLine.update();
                                });

                                document.getElementById('addData').addEventListener('click', function() {
                                    if (config.data.datasets.length > 0) {
                                        var month = MONTHS[config.data.labels.length % MONTHS.length];
                                        config.data.labels.push(month);

                                        config.data.datasets.forEach(function(dataset) {
                                            dataset.data.push(randomScalingFactor());
                                        });

                                        window.myLine.update();
                                    }
                                });

                                document.getElementById('removeDataset').addEventListener('click', function() {
                                    config.data.datasets.splice(0, 1);
                                    window.myLine.update();
                                });

                                document.getElementById('removeData').addEventListener('click', function() {
                                    config.data.labels.splice(-1, 1); // remove the label first

                                    config.data.datasets.forEach(function(dataset) {
                                        dataset.data.pop();
                                    });

                                    window.myLine.update();
                                });
                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script> -->
    <script type="text/javascript" src=" {{ asset('js/sweetalert.min.js') }}"></script>
    @endguest
</body>

</html>