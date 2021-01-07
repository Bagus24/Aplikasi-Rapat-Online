<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agenda;
use App\Notifikasi;
use Illuminate\Support\Facades\Auth;

class LaporanPertahunController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $resmi = Agenda::orderBy('jenis')->where('jenis', 'Resmi')->count();
            $tidakresmi = Agenda::orderBy('jenis')->where('jenis', 'Tidak resmi')->count();
            $penjelasan = Agenda::orderBy('jenis')->where('jenis', 'Penjelasan')->count();
            $pm = Agenda::orderBy('jenis')->where('jenis', 'Pemecahan Masalah')->count();
            $perundingan = Agenda::orderBy('jenis')->where('jenis', 'Perundingan')->count();
            $terbuka = Agenda::orderBy('jenis')->where('jenis', 'Terbuka')->count();
            $tertutup = Agenda::orderBy('jenis')->where('jenis', 'Tertutup')->count();
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();

            return view('laporan.laporan_pertahun', compact('resmi', 'tidakresmi', 'penjelasan', 'pm', 'perundingan', 'terbuka', 'tertutup', 'notifikasi', 'count'));
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

            $resmi = Agenda::orderBy('jenis', 'asc')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $tidakresmi = Agenda::orderBy('jenis')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $penjelasan = Agenda::orderBy('jenis')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $pm = Agenda::orderBy('jenis')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $perundingan = Agenda::orderBy('jenis')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $terbuka = Agenda::orderBy('jenis')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $tertutup = Agenda::orderBy('jenis')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();

            return view('laporan.laporan_pertahun', compact('resmi', 'tidakresmi', 'penjelasan', 'pm', 'perundingan', 'terbuka', 'tertutup', 'notifikasi', 'count'));
        }
        return view('welcome');
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $admin = Notifikasi::where('nama_peserta', $id)->update([
            'status' => $request['status'],
        ]);
        return redirect('laporan-pertahun');
    }

    public function cari(Request $request)
    {

        $tahun = $request['tahun'];
        $jenis = $request['jenis'];

        if ($tahun == '' && $jenis == 'jenis') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        if ($tahun == '') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->where('jenis', $jenis)->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        if ($jenis == 'jenis') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->where('tahun', $tahun)->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        $agenda = Agenda::orderBy('tanggal', 'desc')->where('jenis', $jenis)
            ->where('tahun', $tahun)
            ->get();

        $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
        return $pdf->stream();
    }


    public function destroy($id)
    {
        //
    }
}
