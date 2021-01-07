<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Rapat</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            padding: 50px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 80%;
            background-color: #ffffff;
            margin: 0 auto;
            line-height: 4px;
        }

        .ukuran {
            font-size: 14px;
            line-height: 20px;
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

        hr {
            border: 0;
            border-top: 3px double #000000;

        }

        .logo {
            width: 100px;
            height: 100px;
        }


        .menu {
            width: 25%;
            float: left;
            padding: 15px;
            text-align: left;
            line-height: 20px;
        }

        .main {
            width: 75%;
            float: left;
            padding-top: 15px;
            
            text-align: right;
            line-height: 20px;
        }

        .duapuluh {
            width: 20%;
            float: left;
            text-align: justify;
            line-height: 20px;
        }

        .delapanpuluh {
            width: 80%;
            float: left;
            text-align: justify;
            line-height: 20px;
        }

        .enampuluhlima {
            width: 65%;
            float: left;
            text-align: center;
            line-height: 20px;
            border: 1px solid white;
        }

        .tigapuluhlima {
            width: 35%;
            float: left;
            text-align: left;
            line-height: 20px;
            border: 1px solid white;
        }
    </style>
</head>

<body style="background-color: #f1f4f6;">

    <div class="column">
        <div class="card">
        <img style="float: left;" src="{{ $message->embed(public_path() . '/kop/poltektegal.png') }}" width="120px" height="120px" />
            <div style="text-align: center;">
                <p>Yayasan Pendidikan Harapan Bersama</p>
                <p class="poltek"><span class="warnamerah">PoliTekniK </span><span class="warnabiru">Harapan Bersama</span></p>
                <p>Kampus I. Jl. Mataram No.9 Tegal 52142 Telp. 0283-352000 Fax. 0283-353353</p>
                <p>Kampus II. Jl. Dewi Sartika No.71 Tegal 52117 Telp. 0283-350567</p>
                <p class="websiteemail">Website : www.poltektegal.ac.id &nbsp; Email : sekretariat@poltektegal.ac.id</p>
            </div>

            <br>
            <hr>
            <div class="ukuran">
                
                <br>
                <br>
                <p>Hal : Undangan Rapat</p>


                <div class="main"><span>Kepada Yth. </span></div>
                <div class="menu">
                    <span>{{ $namapesertaemail }}</span>
                    <br>
                    <span>Di Tempat</span>
                </div>
                <br>
                <br>
                <br>
                <br>
                <p>Dengan Hormat, </p>
                <p style="text-align: justify;">Sehubungan dengan akan diadakanya rapat {{ $pembahasan }}, kami mengharapkan keikutsertaan Bapak / Ibu pada :</p>

                <div class="duapuluh"> <span>Tanggal</span> </div>
                <div class="delapanpuluh"><span>: {{ $tanggal }}</span></div>
                <div class="duapuluh"> <span>Waktu</span> </div>
                <div class="delapanpuluh"><span>: Pukul {{ $waktu }} wib</span></div>
                <div class="duapuluh"> <span>Ruangan</span> </div>
                <div class="delapanpuluh"><span>: {{ $ruangan }}</span></div>
                <div class="duapuluh"> <span>Website</span> </div>
                <div class="delapanpuluh"><span>: <a href="https://rapatonlinepoltektegal.tapunyaku.com">https://rapatonlinepoltektegal.tapunyaku.com</a> </span></div>
                <br><br><br>
                <p style="text-align: justify;">Demikian undangan ini disampaikan. Kami mohon keikutsertaan Bapak / Ibu tepat pada waktunya, atas perhatianya kami mengucapkan terima kasih.</p>
                <br><br>
                <div class="enampuluhlima"></div>
                <div class="tigapuluhlima">
                    <span>Tegal, {{ $tglfix }}</span>
                    <br>
                    <span>Ka. Prodi D4 Teknik Informatika,</span>
                    <br>
                    <img src="{{ $message->embed(public_path() . '/kop/tandatangan.jpg') }}" alt="">
                    <br>
                    <span><u> <b>Ginanjar Wiro Sasmito, M.Kom</b> </u></span>
                    <br>
                    <span>NIPY : 10.007.032</span>
                    
                </div>

            </div>

          
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>



</body>

</html>