<?php

namespace App\Http\Controllers;

use App\Notula;
use App\Agenda;
use App\Ruangan;
use App\Message;
use App\Pesertarapat;
use PDF;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotulaController extends Controller
{

    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.notula.notula', compact('agenda'));
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
        $cari = $request->cari;
        $agenda = Agenda::orderBy('tanggal', 'desc')->where('pembahasan', 'like', "%" . $cari . "%")
            ->orwhere('tanggal', 'like', "%" . $cari . "%")
            ->orwhere('kode', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('admin.notula.notula', compact('agenda'));
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
        // $notula = Notula::findOrFail($id);
        // $notula->delete();

        // return redirect('notula')->with('hapus', 'Data telah dihapus!');
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
        }elseif ($bulan == '02' ) {
            $bulan = 'Februari';
        }elseif ($bulan == '03' ) {
            $bulan = 'Maret';
        }elseif ($bulan == '04' ) {
            $bulan = 'April';
        }elseif ($bulan == '05' ) {
            $bulan = 'Mei';
        }elseif ($bulan == '06') {
            $bulan = 'Juni';
        }elseif ($bulan == '07') {
            $bulan = 'Juli';
        }elseif ($bulan == '08') {
            $bulan = 'Agustus';
        }elseif ($bulan == '09') {
            $bulan = 'September';
        }elseif ($bulan == '10') {
            $bulan = 'Oktober';
        }elseif ($bulan == '11') {
            $bulan = 'November';
        }elseif ($bulan == '12') {
            $bulan = 'Desember';
        }

        $peserta = $agenda['peserta'];
        $explode = explode(" | ", $peserta);
      
        $message = Message::all()->where('kode', $kode);
        $ambilnama = [];
        foreach ($explode as $ex) {
            
            $ambiluser = User::orderBy('nama', 'asc')->where('nipy', $ex)->get('nama');

            $ambilnama[] = $ambiluser[0];
        }
        
        $pdf = PDF::loadView('admin.notula.cetak', ['agenda' => $agenda], ['message' => $message, 'hari' => $hari, 'bulan' => $bulan, 'tahun' => $tahun, 'ambilnama' => $ambilnama,]);
        return $pdf->stream();
       
    }
}
