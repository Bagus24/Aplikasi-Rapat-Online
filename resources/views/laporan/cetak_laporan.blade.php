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

        table {
            font-family: arial, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            font-size: 12px;
            text-align: left;
            padding: 4px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
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

    <center>
        <h4 style="text-transform: uppercase;">LAPORAN RAPAT</h4>
    </center>

        <table>

            <tr>
                <th>No.</th>
                <th>Jenis Rapat</th>
                <th>Pembahasan</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Ruangan</th>
                <th>Pemimpin Rapat</th>
            </tr>

            @if ($agenda->count() > 0)
            <?php $no = 0; ?>
            @foreach($agenda as $a)
            <?php $no++; ?>
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $a->jenis }}</td>
                <td>{{ $a->pembahasan }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->mulai }}</td>
                <td>{{ $a->selesai }}</td>
                <td>{{ $a->kode }}</td>
                <td>{{ $a->pimpinan }}</td>
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

            </tr>
            @endif

        </table>



</body>

</html>