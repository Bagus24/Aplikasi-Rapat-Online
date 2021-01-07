<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Message;
use App\Pesertarapat;
use PDF;
use App\Notifikasi;
use Auth;
use App\user;
use Illuminate\Http\Request;

class NotulaPesertaController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            return view('notula.notula', compact('agenda', 'notifikasi', 'count'));
        }
        return view('welcome');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Request $request)
    {
        if (Auth::check()) {
            $cari = $request->cari;
            $agenda = Agenda::orderBy('tanggal', 'desc')->where('pembahasan', 'like', "%" . $cari . "%")
                ->orwhere('tanggal', 'like', "%" . $cari . "%")
                ->orwhere('ruangan', 'like', "%" . $cari . "%")
                ->paginate(10);
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            return view('notula.notula', compact('agenda', 'notifikasi', 'count'));
        }
        return view('welcome');
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function cetak($id)
    {
        $agenda = Agenda::find($id);
        $kode = $agenda['kode'];
        $pembahasan = $agenda['pembahasan'];
        $tanggal = $agenda['tanggal'];

        $hari = substr($tanggal, 8, 2);
        $bulan = substr($tanggal, 5, 2);
        $tahun = substr($tanggal, 0, 4);

        if ($bulan == '01') {
            $bulan = 'Januari';
        } elseif ($bulan == '02') {
            $bulan = 'Februari';
        } elseif ($bulan == '03') {
            $bulan = 'Maret';
        } elseif ($bulan == '04') {
            $bulan = 'April';
        } elseif ($bulan == '05') {
            $bulan = 'Mei';
        } elseif ($bulan == '06') {
            $bulan = 'Juni';
        } elseif ($bulan == '07') {
            $bulan = 'Juli';
        } elseif ($bulan == '08') {
            $bulan = 'Agustus';
        } elseif ($bulan == '09') {
            $bulan = 'September';
        } elseif ($bulan == '10') {
            $bulan = 'Oktober';
        } elseif ($bulan == '11') {
            $bulan = 'November';
        } elseif ($bulan == '12') {
            $bulan = 'Desember';
        }



        $message = Message::all()->where('kode', $kode);

        $peserta = $agenda['peserta'];
        $explode = explode(" | ", $peserta);
        $ambilnama = [];
        foreach ($explode as $ex) {

            $ambiluser = User::orderBy('nama', 'asc')->where('nipy', $ex)->get('nama');

            $ambilnama[] = $ambiluser[0];
        }


        $pdf = PDF::loadView('notula.cetak', ['agenda' => $agenda], ['message' => $message, 'hari' => $hari, 'bulan' => $bulan, 'tahun' => $tahun,  'ambilnama' => $ambilnama,]);
        return $pdf->stream();
    }
}
