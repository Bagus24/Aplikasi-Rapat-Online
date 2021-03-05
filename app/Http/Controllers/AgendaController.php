<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Agenda;
use App\Ruangan;
use App\Peserta;
use App\Pesertarapat;
use App\Message;
use App\Validasiagenda;
use App\Notifikasi;
use App\User;
use App\Jenisrapat;
use Mail;
use App\Mail\RapatOnlineEmail;

class AgendaController extends Controller
{

    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);

        return view('admin.agenda.agenda', compact('agenda'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        $peserta = Peserta::all();

        return view('admin.agenda.tambah_agenda', compact('ruangan', 'peserta'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'jenis' => ['required', 'string', 'max:40'],
            'pembahasan' => ['required', 'string', 'max:100',],
            'tanggal' => ['required'],
            'mulai' => ['required', 'string'],
            'selesai' => ['required', 'string'],
            'kode' => ['required', 'string', 'max:12', 'unique:agenda'],
            'pimpinan' => ['required'],
            'peserta' => ['required'],

        ]);
    }
    public function store(Request $request)
    {
        $ambiltanggal = $request['tanggal'];
        $ambilbulan = substr($ambiltanggal, 5, 2);
        $ambiltahun = substr($ambiltanggal, 0, 4);
        $ambilhari = substr($ambiltanggal, 8, 2);
        $waktumulai = $request['mulai'];
        $waktuselesai = $request['selesai'];
        $peserta = $request['peserta'];
        $ambilpimpinan = $request['pimpinan'];
        $pimpinan = substr($ambilpimpinan, 10);
        $nipypimpinan = substr($ambilpimpinan, 0, 10);
        $implode = implode(" | ", $peserta);
        $valpimpinan = '';
        if (in_array($nipypimpinan, $peserta)) {
            $valpimpinan = 'ada yang sama';
            
        } else {
            $valpimpinan =  'gagal';
        }

        if ($valpimpinan == 'gagal') {
            return redirect('agenda')->with('errorpimpinan', 'Pemimpin rapat tidak terdaftar!');
        }

        date_default_timezone_set('Asia/Jakarta');
        $sekarang = date("Y-m-d");
        $tanggalsekarang = date("d");
        $bulansekarang = date("m");
        $tahunsekarang = date("Y");

        

        if ($ambiltahun < $tahunsekarang | $ambilbulan < $bulansekarang | $ambilhari < $tanggalsekarang) {
            return redirect('agenda')->with('errortanggal', 'Tanggal sudah berlalu!');
        }
        $waktusekarang = date("H:i");
        if ($waktumulai < $waktusekarang && $ambiltanggal == $sekarang) {
            return redirect('agenda')->with('errorwaktumulai', 'Waktu mulai sudah berlalu!');
        }

        $nama_peserta = [];
        foreach ($peserta as $p) {
            $ambilusernya = User::where('nipy', $p)->get();
            $nama_peserta[] = $ambilusernya[0]['nama'];
        }

        $implodenama = implode(" | ", $nama_peserta);

        $validasiagenda = Validasiagenda::orderBy('mulai', 'asc')->where('tanggal', $ambiltanggal)->get();


        if ($waktuselesai < $waktumulai) {
            return redirect('agenda')->with('errorwaktu', 'Waktu rapat salah');
        }

        $hasilval = '';

        foreach ($validasiagenda as $val1) {

            if (in_array($val1->peserta, $peserta)) {
                $hasilval = 'ada yang sama';
                break;
            } else {
                $hasilval =  'gagal';
            }
        }


        if ($hasilval == 'ada yang sama') {
            $datavalidasi1 = [];
            foreach ($peserta as $p) {
                $datavalidasi1[] = Validasiagenda::where('tanggal', $ambiltanggal)->where('peserta', $p)->get();
            }

            $mulai = [];
            $selesai = [];
            $hitung = count($datavalidasi1);
            for ($i = 0; $i < $hitung; $i++) {
                $cek = $datavalidasi1[$i];
                if ($cek != '[]') {
                    $mulai[] = $datavalidasi1[$i][0]['mulai'];
                }
            }

            for ($i = 0; $i < $hitung; $i++) {

                $cek = $datavalidasi1[$i];
                if ($cek != '[]') {
                    $selesai[] = $datavalidasi1[$i][0]['selesai'];
                }
            }



            $hasil = '';
            foreach ($mulai as $m => $waktu) {

                if ($waktumulai > $waktu && $waktumulai < $selesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } else if ($waktuselesai > $waktu && $waktuselesai < $selesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } elseif ($waktumulai <= $waktu && $waktuselesai >= $selesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } elseif ($waktuselesai >= $waktu && $waktumulai <= $selesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } else {
                    $hasil = 'lanjut';
                }
            }


            if ($hasil == 'tidak bisa lanjut') {
                return redirect('agenda')->with('errorpeserta', 'Salah satu peserta berada pada Rapat lain');
            } else {
                $this->validator($request->all())->validate();
                $admin = Agenda::create([
                    'jenis' => $request['jenis'],
                    'pembahasan' => $request['pembahasan'],
                    'tanggal' => $request['tanggal'],
                    'mulai' => $request['mulai'],
                    'selesai' => $request['selesai'],
                    'kode' => $request['kode'],
                    'bulan' => $ambilbulan,
                    'tahun' => $ambiltahun,
                    'peserta' => $implode,
                    'nama_peserta' => $implodenama,
                    'pimpinan' => $pimpinan,
                ]);

                $data = [];
                foreach ($peserta as $p) {
                    $data[] = [
                        'tanggal' => $request['tanggal'],
                        'mulai' => $request['mulai'],
                        'selesai' => $request['selesai'],
                        'peserta' => $p,
                        'kode' => $request['kode'],
                    ];
                }
                Validasiagenda::insert($data);

                $notiftanggal = $request['tanggal'];

                $notifhari = substr($notiftanggal, 8, 2);
                $notifbulan = substr($notiftanggal, 5, 2);
                $notiftahun = substr($notiftanggal, 0, 4);

                if ($notifbulan == '01') {
                    $notifbulan = 'Januari';
                } elseif ($notifbulan == '02') {
                    $notifbulan = 'Februari';
                } elseif ($notifbulan == '03') {
                    $notifbulan = 'Maret';
                } elseif ($notifbulan == '04') {
                    $notifbulan = 'April';
                } elseif ($notifbulan == '05') {
                    $notifbulan = 'Mei';
                } elseif ($notifbulan == '06') {
                    $notifbulan = 'Juni';
                } elseif ($notifbulan == '07') {
                    $notifbulan = 'Juli';
                } elseif ($notifbulan == '08') {
                    $notifbulan = 'Agustus';
                } elseif ($notifbulan == '09') {
                    $notifbulan = 'September';
                } elseif ($notifbulan == '10') {
                    $notifbulan = 'Oktober';
                } elseif ($notifbulan == '11') {
                    $notifbulan = 'November';
                } elseif ($notifbulan == '12') {
                    $notifbulan = 'Desember';
                }

                $campurantanggal = $notifhari . " " . $notifbulan . " " . $notiftahun;

                $notifikasi = [];
                foreach ($peserta as $p) {
                    $notifikasi[] = [
                        'kode' => $request['kode'],
                        'pesan' => 'Agenda rapat baru di buat!',
                        'tanggal' => $campurantanggal,
                        'nama_peserta' => $p,
                        'status' => 'baru',
                    ];
                }
                Notifikasi::insert($notifikasi);

                $ambilemail = [];
                foreach ($peserta as $p) {
                    $ambiluser = User::where('nipy', $p)->get();
                    $ambilemail[] = $ambiluser[0]['email'];
                }

                $emailpembahasan = $request['pembahasan'];
                $emailtanggal = $campurantanggal;
                $emailwaktu = $request['mulai'] . ' - ' . $request['selesai'];
                $emailruangan = $request['kode'];
                $emailpemimpin = $pimpinan;
                date_default_timezone_set('Asia/Jakarta');
                $tanggalemail = date("d");
                $bulanemail = date("m");
                $tahunemail = date("Y");

                if ($bulanemail == '01') {
                    $bulanemail = 'Januari';
                } elseif ($bulanemail == '02') {
                    $bulanemail = 'Februari';
                } elseif ($bulanemail == '03') {
                    $bulanemail = 'Maret';
                } elseif ($bulanemail == '04') {
                    $bulanemail = 'April';
                } elseif ($bulanemail == '05') {
                    $bulanemail = 'Mei';
                } elseif ($bulanemail == '06') {
                    $bulanemail = 'Juni';
                } elseif ($bulanemail == '07') {
                    $bulanemail = 'Juli';
                } elseif ($bulanemail == '08') {
                    $bulanemail = 'Agustus';
                } elseif ($bulanemail == '09') {
                    $bulanemail = 'September';
                } elseif ($bulanemail == '10') {
                    $bulanemail = 'Oktober';
                } elseif ($bulanemail == '11') {
                    $bulanemail = 'November';
                } elseif ($bulanemail == '12') {
                    $bulanemail = 'Desember';
                }

                $tglfix = $tanggalemail . " " . $bulanemail . " " . $tahunemail;

                foreach ($ambilemail as $ae) {
                    $ambil = User::where('email', $ae)->first();
                    $namapesertaemail = $ambil['nama'];
                    Mail::to($ae)->send(new RapatOnlineEmail($emailpembahasan, $emailtanggal, $emailwaktu, $emailruangan, $emailpemimpin, $namapesertaemail, $tglfix));
                }

                return redirect('agenda')->with('tambah', 'Data telah ditambahkan!');
            }
        } else {
            $this->validator($request->all())->validate();
            $admin = Agenda::create([
                'jenis' => $request['jenis'],
                'pembahasan' => $request['pembahasan'],
                'tanggal' => $request['tanggal'],
                'mulai' => $request['mulai'],
                'selesai' => $request['selesai'],
                'kode' => $request['kode'],
                'bulan' => $ambilbulan,
                'tahun' => $ambiltahun,
                'peserta' => $implode,
                'nama_peserta' => $implodenama,
                'pimpinan' => $pimpinan,
            ]);
            $data = [];
            foreach ($peserta as $p) {
                $data[] = [
                    'tanggal' => $request['tanggal'],
                    'mulai' => $request['mulai'],
                    'selesai' => $request['selesai'],
                    'peserta' => $p,
                    'kode' => $request['kode'],
                ];
            }


            Validasiagenda::insert($data);

            $notiftanggal = $request['tanggal'];

            $notifhari = substr($notiftanggal, 8, 2);
            $notifbulan = substr($notiftanggal, 5, 2);
            $notiftahun = substr($notiftanggal, 0, 4);

            if ($notifbulan == '01') {
                $notifbulan = 'Januari';
            } elseif ($notifbulan == '02') {
                $notifbulan = 'Februari';
            } elseif ($notifbulan == '03') {
                $notifbulan = 'Maret';
            } elseif ($notifbulan == '04') {
                $notifbulan = 'April';
            } elseif ($notifbulan == '05') {
                $notifbulan = 'Mei';
            } elseif ($notifbulan == '06') {
                $notifbulan = 'Juni';
            } elseif ($notifbulan == '07') {
                $notifbulan = 'Juli';
            } elseif ($notifbulan == '08') {
                $notifbulan = 'Agustus';
            } elseif ($notifbulan == '09') {
                $notifbulan = 'September';
            } elseif ($notifbulan == '10') {
                $notifbulan = 'Oktober';
            } elseif ($notifbulan == '11') {
                $notifbulan = 'November';
            } elseif ($notifbulan == '12') {
                $notifbulan = 'Desember';
            }

            $campurantanggal = $notifhari . " " . $notifbulan . " " . $notiftahun;

            $notifikasi = [];
            foreach ($peserta as $p) {
                $notifikasi[] = [
                    'kode' => $request['kode'],
                    'pesan' => 'Agenda rapat baru di buat!',
                    'tanggal' => $campurantanggal,
                    'nama_peserta' => $p,
                    'status' => 'baru',
                ];
            }
            Notifikasi::insert($notifikasi);

            $ambilemail = [];
            foreach ($peserta as $p) {
                $ambiluser = User::where('nipy', $p)->get();
                $ambilemail[] = $ambiluser[0]['email'];
            }
            $emailpembahasan = $request['pembahasan'];
            $emailtanggal = $campurantanggal;
            $emailwaktu = $request['mulai'] . ' - ' . $request['selesai'];
            $emailruangan = $request['kode'];
            $emailpemimpin = $pimpinan;
            date_default_timezone_set('Asia/Jakarta');
            $tanggalemail = date("d");
            $bulanemail = date("m");
            $tahunemail = date("Y");

            if ($bulanemail == '01') {
                $bulanemail = 'Januari';
            } elseif ($bulanemail == '02') {
                $bulanemail = 'Februari';
            } elseif ($bulanemail == '03') {
                $bulanemail = 'Maret';
            } elseif ($bulanemail == '04') {
                $bulanemail = 'April';
            } elseif ($bulanemail == '05') {
                $bulanemail = 'Mei';
            } elseif ($bulanemail == '06') {
                $bulanemail = 'Juni';
            } elseif ($bulanemail == '07') {
                $bulanemail = 'Juli';
            } elseif ($bulanemail == '08') {
                $bulanemail = 'Agustus';
            } elseif ($bulanemail == '09') {
                $bulanemail = 'September';
            } elseif ($bulanemail == '10') {
                $bulanemail = 'Oktober';
            } elseif ($bulanemail == '11') {
                $bulanemail = 'November';
            } elseif ($bulanemail == '12') {
                $bulanemail = 'Desember';
            }

            $tglfix = $tanggalemail . " " . $bulanemail . " " . $tahunemail;


            foreach ($ambilemail as $ae) {
                $ambil = User::where('email', $ae)->first();
                $namapesertaemail = $ambil['nama'];

                Mail::to($ae)->send(new RapatOnlineEmail($emailpembahasan, $emailtanggal, $emailwaktu, $emailruangan, $emailpemimpin, $namapesertaemail, $tglfix));
            }

            return redirect('agenda')->with('tambah', 'Data telah ditambahkan!');
        }
    }




    public function show(Request $request)
    {
        $cari = $request->cari;
        $agenda = Agenda::orderBy('tanggal', 'desc')->where('jenis', 'like', "%" . $cari . "%")
            ->orwhere('pembahasan', 'like', "%" . $cari . "%")
            ->orwhere('tanggal', 'like', "%" . $cari . "%")
            ->orwhere('mulai', 'like', "%" . $cari . "%")
            ->orwhere('selesai', 'like', "%" . $cari . "%")
            ->orwhere('kode', 'like', "%" . $cari . "%")
            ->orwhere('pimpinan', 'like', "%" . $cari . "%")
            ->orwhere('peserta', 'like', "%" . $cari . "%")
            ->orwhere('nama_peserta', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('admin.agenda.agenda', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = Agenda::find($id);
        $pembahasan = $agenda['pembahasan'];
        $pesertarapat = $agenda['peserta'];
        $explode = explode(" | ", $pesertarapat);
        $ruangan = Ruangan::all();
        $peserta = Peserta::orderBy('nama', 'asc')->get();

        return view('admin.agenda.sunting_agenda', compact('agenda'), compact('ruangan', 'peserta', 'explode'));
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'jenis' => ['required', 'string', 'max:40'],
            'pembahasan' => ['required', 'string', 'max:100',],
            'tanggal' => ['required'],
            'mulai' => ['required', 'string'],
            'selesai' => ['required', 'string'],
            'kode' => ['required', 'string', 'max:12'],
            'peserta' => ['required'],
            'pimpinan' => ['required'],
        ]);
    }

    protected function validatorRuangan(array $data)
    {
        return Validator::make($data, [
            'kode' => ['required', 'string', 'max:12', 'unique:agenda'],
        ]);
    }


    public function update(Request $request, $id)
    {
        $ambiltanggal = $request['tanggal'];
        $ambilbulan = substr($ambiltanggal, 5, 2);
        $ambiltahun = substr($ambiltanggal, 0, 4);
        $ambilhari = substr($ambiltanggal, 8, 2);
        $waktumulai = $request['mulai'];
        $waktuselesai = $request['selesai'];
        $peserta = $request['peserta'];
        $implode = implode(" | ", $peserta);
        $pimpinan = $request['pimpinan'];
        $editpimpinan = User::where('nama', $pimpinan)->first();
        $nipypimpinan = $editpimpinan['nipy'];
        
  
        
        $valpimpinan = '';
        if (in_array($nipypimpinan, $peserta)) {
            $valpimpinan = 'ada yang sama';
            
        } else {
            $valpimpinan =  'gagal';
        }

        if ($valpimpinan == 'gagal') {
            return redirect('agenda')->with('errorpimpinan', 'Pemimpin rapat tidak terdaftar!');
        }
        

        date_default_timezone_set('Asia/Jakarta');
        $sekarang = date("Y-m-d");
        $tanggalsekarang = date("d");
        $bulansekarang = date("m");
        $tahunsekarang = date("Y");

        
        if ($ambiltahun < $tahunsekarang | $ambilbulan < $bulansekarang | $ambilhari < $tanggalsekarang) {
            return redirect('agenda')->with('errortanggal', 'Tanggal tidak sesuai!');
        }
        $waktusekarang = date("H:i");
        if ($waktumulai < $waktusekarang && $ambiltanggal == $sekarang) {
            return redirect('agenda')->with('errorwaktumulai', 'Waktu mulai sudah berlalu!');
        }

        $id = $request['id'];
        $dataagenda = Agenda::where('id', $id)->get('kode');
        $kode = $dataagenda[0]['kode'];

   
        
        $nama_peserta = [];
        foreach ($peserta as $p) {
            $ambilusernya = User::where('nipy', $p)->get();
            $nama_peserta[] = $ambilusernya[0]['nama'];
        }

        $implodenama = implode(" | ", $nama_peserta);


        $validasiagenda = Validasiagenda::orderBy('mulai', 'asc')->where('tanggal', $ambiltanggal)->where('kode', '!=', $kode)->get();

        

        if ($waktuselesai < $waktumulai) {
            return redirect('agenda')->with('errorwaktuupdate', 'Waktu rapat salah');
        }


        $hasilval5 = '';
        foreach ($validasiagenda as $val5) {

            if (in_array($val5->peserta, $peserta)) {
                $hasilval5 = 'ada yang sama';
                break;
            } else {
                $hasilval5 =  'gagal';
            }
        }



        if ($hasilval5 == 'gagal') {
            $ruangan = Agenda::where('id', $id)->first();
            $ambilruangan = $ruangan['kode'];
            if ($ambilruangan != $request['kode']) {
                $this->validatorRuangan($request->all())->validate();
            }
            $this->validatorUpdate($request->all())->validate();
            $admin = Agenda::whereId($id)->update([
                'jenis' => $request['jenis'],
                'pembahasan' => $request['pembahasan'],
                'tanggal' => $request['tanggal'],
                'mulai' => $request['mulai'],
                'selesai' => $request['selesai'],
                'kode' => $request['kode'],
                'bulan' => $ambilbulan,
                'tahun' => $ambiltahun,
                'peserta' => $implode,
                'nama_peserta' => $implodenama,
                'pimpinan' => $pimpinan,
            ]);
            $hapuspesertalama = Validasiagenda::where('kode', $kode)->delete();
            $hapusnotifikasi = Notifikasi::where('kode', $kode)->delete();

            $data = [];
            foreach ($peserta as $p) {
                $data[] = [
                    'tanggal' => $request['tanggal'],
                    'mulai' => $request['mulai'],
                    'selesai' => $request['selesai'],
                    'peserta' => $p,
                    'kode' => $request['kode'],
                ];
            }
            Validasiagenda::insert($data);

            $notiftanggal = $request['tanggal'];

            $notifhari = substr($notiftanggal, 8, 2);
            $notifbulan = substr($notiftanggal, 5, 2);
            $notiftahun = substr($notiftanggal, 0, 4);

            if ($notifbulan == '01') {
                $notifbulan = 'Januari';
            } elseif ($notifbulan == '02') {
                $notifbulan = 'Februari';
            } elseif ($notifbulan == '03') {
                $notifbulan = 'Maret';
            } elseif ($notifbulan == '04') {
                $notifbulan = 'April';
            } elseif ($notifbulan == '05') {
                $notifbulan = 'Mei';
            } elseif ($notifbulan == '06') {
                $notifbulan = 'Juni';
            } elseif ($notifbulan == '07') {
                $notifbulan = 'Juli';
            } elseif ($notifbulan == '08') {
                $notifbulan = 'Agustus';
            } elseif ($notifbulan == '09') {
                $notifbulan = 'September';
            } elseif ($notifbulan == '10') {
                $notifbulan = 'Oktober';
            } elseif ($notifbulan == '11') {
                $notifbulan = 'November';
            } elseif ($notifbulan == '12') {
                $notifbulan = 'Desember';
            }

            $campurantanggal = $notifhari . " " . $notifbulan . " " . $notiftahun;

            $notifikasi = [];
            foreach ($peserta as $p) {
                $notifikasi[] = [
                    'kode' => $request['kode'],
                    'pesan' => 'Agenda rapat di ubah!',
                    'tanggal' => $campurantanggal,
                    'nama_peserta' => $p,
                    'status' => 'baru',
                ];
            }
            Notifikasi::insert($notifikasi);

            $ambilemail = [];
            foreach ($peserta as $p) {
                $ambiluser = User::where('nipy', $p)->get();
                $ambilemail[] = $ambiluser[0]['email'];
            }

            $emailpembahasan = $request['pembahasan'];
            $emailtanggal = $campurantanggal;
            $emailwaktu = $request['mulai'] . ' - ' . $request['selesai'];
            $emailruangan = $request['kode'];
            $emailpemimpin = $pimpinan;
            date_default_timezone_set('Asia/Jakarta');
            $tanggalemail = date("d");
            $bulanemail = date("m");
            $tahunemail = date("Y");

            if ($bulanemail == '01') {
                $bulanemail = 'Januari';
            } elseif ($bulanemail == '02') {
                $bulanemail = 'Februari';
            } elseif ($bulanemail == '03') {
                $bulanemail = 'Maret';
            } elseif ($bulanemail == '04') {
                $bulanemail = 'April';
            } elseif ($bulanemail == '05') {
                $bulanemail = 'Mei';
            } elseif ($bulanemail == '06') {
                $bulanemail = 'Juni';
            } elseif ($bulanemail == '07') {
                $bulanemail = 'Juli';
            } elseif ($bulanemail == '08') {
                $bulanemail = 'Agustus';
            } elseif ($bulanemail == '09') {
                $bulanemail = 'September';
            } elseif ($bulanemail == '10') {
                $bulanemail = 'Oktober';
            } elseif ($bulanemail == '11') {
                $bulanemail = 'November';
            } elseif ($bulanemail == '12') {
                $bulanemail = 'Desember';
            }

            $tglfix = $tanggalemail . " " . $bulanemail . " " . $tahunemail;


            foreach ($ambilemail as $ae) {
                $ambil = User::where('email', $ae)->first();
                $namapesertaemail = $ambil['nama'];

                Mail::to($ae)->send(new RapatOnlineEmail($emailpembahasan, $emailtanggal, $emailwaktu, $emailruangan, $emailpemimpin, $namapesertaemail, $tglfix));
            }

            return redirect('agenda')->with('sunting', 'Data telah diubah!');
        } else {

            $datavalidasi1 = [];
            foreach ($peserta as $p) {
                $datavalidasi1[] = Validasiagenda::where('tanggal', $ambiltanggal)->where('peserta', $p)->where('kode', '!=', $kode)->get();
            }

            $updatemulai = [];
            $updateselesai = [];
            $hitung = count($datavalidasi1);
            for ($i = 0; $i < $hitung; $i++) {
                $cek = $datavalidasi1[$i];
                if ($cek != '[]') {
                    $updatemulai[] = $datavalidasi1[$i][0]['mulai'];
                }
            }

            for ($i = 0; $i < $hitung; $i++) {

                $cek = $datavalidasi1[$i];
                if ($cek != '[]') {
                    $updateselesai[] = $datavalidasi1[$i][0]['selesai'];
                }
            }

            $hasil = '';
            foreach ($updatemulai as $m => $waktu) {

                if ($waktumulai > $waktu && $waktumulai < $updateselesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } else if ($waktuselesai > $waktu && $waktuselesai < $updateselesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } elseif ($waktumulai <= $waktu && $waktuselesai >= $updateselesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } elseif ($waktuselesai >= $waktu && $waktumulai <= $updateselesai[$m]) {
                    $hasil = 'tidak bisa lanjut';
                    break;
                } else {
                    $hasil = 'lanjut';
                }
            }


            if ($hasil == 'tidak bisa lanjut') {
                return redirect('agenda')->with('errorupdate', 'Salah satu peserta berada pada Rapat lain');
            } else {
                $ruangan = Agenda::where('id', $id)->first();
                $ambilruangan = $ruangan['kode'];
                if ($ambilruangan != $request['kode']) {
                    $this->validatorRuangan($request->all())->validate();
                }
                $this->validatorUpdate($request->all())->validate();
                $admin = Agenda::whereId($id)->update([
                    'jenis' => $request['jenis'],
                    'pembahasan' => $request['pembahasan'],
                    'tanggal' => $request['tanggal'],
                    'mulai' => $request['mulai'],
                    'selesai' => $request['selesai'],
                    'kode' => $request['kode'],
                    'bulan' => $ambilbulan,
                    'tahun' => $ambiltahun,
                    'peserta' => $implode,
                    'nama_peserta' => $implodenama,
                    'pimpinan' => $pimpinan,
                ]);
                $hapuspesertalama = Validasiagenda::where('kode', $kode)->delete();
                $hapusnotifikasi = Notifikasi::where('kode', $kode)->delete();

                $data = [];
                foreach ($peserta as $p) {
                    $data[] = [
                        'tanggal' => $request['tanggal'],
                        'mulai' => $request['mulai'],
                        'selesai' => $request['selesai'],
                        'peserta' => $p,
                        'kode' => $request['kode'],
                    ];
                }
                Validasiagenda::insert($data);

                $notiftanggal = $request['tanggal'];

                $notifhari = substr($notiftanggal, 8, 2);
                $notifbulan = substr($notiftanggal, 5, 2);
                $notiftahun = substr($notiftanggal, 0, 4);

                if ($notifbulan == '01') {
                    $notifbulan = 'Januari';
                } elseif ($notifbulan == '02') {
                    $notifbulan = 'Februari';
                } elseif ($notifbulan == '03') {
                    $notifbulan = 'Maret';
                } elseif ($notifbulan == '04') {
                    $notifbulan = 'April';
                } elseif ($notifbulan == '05') {
                    $notifbulan = 'Mei';
                } elseif ($notifbulan == '06') {
                    $notifbulan = 'Juni';
                } elseif ($notifbulan == '07') {
                    $notifbulan = 'Juli';
                } elseif ($notifbulan == '08') {
                    $notifbulan = 'Agustus';
                } elseif ($notifbulan == '09') {
                    $notifbulan = 'September';
                } elseif ($notifbulan == '10') {
                    $notifbulan = 'Oktober';
                } elseif ($notifbulan == '11') {
                    $notifbulan = 'November';
                } elseif ($notifbulan == '12') {
                    $notifbulan = 'Desember';
                }

                $campurantanggal = $notifhari . " " . $notifbulan . " " . $notiftahun;

                $notifikasi = [];
                foreach ($peserta as $p) {
                    $notifikasi[] = [
                        'kode' => $request['kode'],
                        'pesan' => 'Agenda rapat di ubah!',
                        'tanggal' => $campurantanggal,
                        'nama_peserta' => $p,
                        'status' => 'baru',
                    ];
                }
                Notifikasi::insert($notifikasi);

                $ambilemail = [];
                foreach ($peserta as $p) {
                    $ambiluser = User::where('nipy', $p)->get();
                    $ambilemail[] = $ambiluser[0]['email'];
                }

                $emailpembahasan = $request['pembahasan'];
                $emailtanggal = $campurantanggal;
                $emailwaktu = $request['mulai'] . ' - ' . $request['selesai'];
                $emailruangan = $request['kode'];
                $emailpemimpin = $pimpinan;
                date_default_timezone_set('Asia/Jakarta');
                $tanggalemail = date("d");
                $bulanemail = date("m");
                $tahunemail = date("Y");

                if ($bulanemail == '01') {
                    $bulanemail = 'Januari';
                } elseif ($bulanemail == '02') {
                    $bulanemail = 'Februari';
                } elseif ($bulanemail == '03') {
                    $bulanemail = 'Maret';
                } elseif ($bulanemail == '04') {
                    $bulanemail = 'April';
                } elseif ($bulanemail == '05') {
                    $bulanemail = 'Mei';
                } elseif ($bulanemail == '06') {
                    $bulanemail = 'Juni';
                } elseif ($bulanemail == '07') {
                    $bulanemail = 'Juli';
                } elseif ($bulanemail == '08') {
                    $bulanemail = 'Agustus';
                } elseif ($bulanemail == '09') {
                    $bulanemail = 'September';
                } elseif ($bulanemail == '10') {
                    $bulanemail = 'Oktober';
                } elseif ($bulanemail == '11') {
                    $bulanemail = 'November';
                } elseif ($bulanemail == '12') {
                    $bulanemail = 'Desember';
                }

                $tglfix = $tanggalemail . " " . $bulanemail . " " . $tahunemail;


                foreach ($ambilemail as $ae) {
                    $ambil = User::where('email', $ae)->first();
                    $namapesertaemail = $ambil['nama'];

                    Mail::to($ae)->send(new RapatOnlineEmail($emailpembahasan, $emailtanggal, $emailwaktu, $emailruangan, $emailpemimpin, $namapesertaemail, $tglfix));
                }

                return redirect('agenda')->with('sunting', 'Data telah diubah!');
            }
        }
    }
















    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $kode = $agenda['kode'];
        $hapusmessage = Message::where('kode', $kode)->delete();
        $hapusvalidasi = Validasiagenda::where('kode', $kode)->delete();
        $hapusnotifikasi = Notifikasi::where('kode', $kode)->delete();
        $agenda->delete();
        return redirect('agenda')->with('hapus', 'Data telah dihapus!');
    }
}
