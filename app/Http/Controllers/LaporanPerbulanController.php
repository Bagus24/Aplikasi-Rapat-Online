<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agenda;
use App\Notifikasi;
use Illuminate\Support\Facades\Auth;

class LaporanPerbulanController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            //bulan dan resmi
            $januariresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Resmi')->count();
            $februariresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Resmi')->count();
            $maretresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Resmi')->count();
            $aprilresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Resmi')->count();
            $meiresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Resmi')->count();
            $juniresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Resmi')->count();
            $juliresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Resmi')->count();
            $agustusresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Resmi')->count();
            $septemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Resmi')->count();
            $oktoberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Resmi')->count();
            $novemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Resmi')->count();
            $desemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Resmi')->count();

            //bulan dan tidak resmi
            $januaritidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Tidak Resmi')->count();
            $februaritidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Tidak Resmi')->count();
            $marettidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Tidak Resmi')->count();
            $apriltidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Tidak Resmi')->count();
            $meitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Tidak Resmi')->count();
            $junitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Tidak Resmi')->count();
            $julitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Tidak Resmi')->count();
            $agustustidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Tidak Resmi')->count();
            $septembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Tidak Resmi')->count();
            $oktobertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Tidak Resmi')->count();
            $novembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Tidak Resmi')->count();
            $desembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Tidak Resmi')->count();

            //bulan dan penjelasan
            $januaripenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Penjelasan')->count();
            $februaripenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Penjelasan')->count();
            $maretpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Penjelasan')->count();
            $aprilpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Penjelasan')->count();
            $meipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Penjelasan')->count();
            $junipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Penjelasan')->count();
            $julipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Penjelasan')->count();
            $agustuspenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Penjelasan')->count();
            $septemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Penjelasan')->count();
            $oktoberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Penjelasan')->count();
            $novemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Penjelasan')->count();
            $desemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Penjelasan')->count();

            //bulan dan pemecahan masalah
            $januaripm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Pemecahan Masalah')->count();
            $februaripm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Pemecahan Masalah')->count();
            $maretpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Pemecahan Masalah')->count();
            $aprilpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Pemecahan Masalah')->count();
            $meipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Pemecahan Masalah')->count();
            $junipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Pemecahan Masalah')->count();
            $julipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Pemecahan Masalah')->count();
            $agustuspm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Pemecahan Masalah')->count();
            $septemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Pemecahan Masalah')->count();
            $oktoberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Pemecahan Masalah')->count();
            $novemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Pemecahan Masalah')->count();
            $desemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Pemecahan Masalah')->count();

            //bulan dan perundingan
            $januariperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Perundingan')->count();
            $februariperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Perundingan')->count();
            $maretperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Perundingan')->count();
            $aprilperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Perundingan')->count();
            $meiperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Perundingan')->count();
            $juniperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Perundingan')->count();
            $juliperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Perundingan')->count();
            $agustusperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Perundingan')->count();
            $septemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Perundingan')->count();
            $oktoberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Perundingan')->count();
            $novemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Perundingan')->count();
            $desemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Perundingan')->count();

            //bulan dan terbuka
            $januariterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Terbuka')->count();
            $februariterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Terbuka')->count();
            $maretterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Terbuka')->count();
            $aprilterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Terbuka')->count();
            $meiterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Terbuka')->count();
            $juniterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Terbuka')->count();
            $juliterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Terbuka')->count();
            $agustusterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Terbuka')->count();
            $septemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Terbuka')->count();
            $oktoberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Terbuka')->count();
            $novemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Terbuka')->count();
            $desemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Terbuka')->count();

            //bulan dan tertutup
            $januaritertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Tertutup')->count();
            $februaritertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Tertutup')->count();
            $marettertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Tertutup')->count();
            $apriltertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Tertutup')->count();
            $meitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Tertutup')->count();
            $junitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Tertutup')->count();
            $julitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Tertutup')->count();
            $agustustertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Tertutup')->count();
            $septembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Tertutup')->count();
            $oktobertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Tertutup')->count();
            $novembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Tertutup')->count();
            $desembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Tertutup')->count();



            return view(
                'laporan.laporan_perbulan',
                compact(
                    'januariresmi',
                    'februariresmi',
                    'maretresmi',
                    'aprilresmi',
                    'meiresmi',
                    'juniresmi',
                    'juliresmi',
                    'agustusresmi',
                    'septemberresmi',
                    'oktoberresmi',
                    'novemberresmi',
                    'desemberresmi',

                    'januaritidakresmi',
                    'februaritidakresmi',
                    'marettidakresmi',
                    'apriltidakresmi',
                    'meitidakresmi',
                    'junitidakresmi',
                    'julitidakresmi',
                    'agustustidakresmi',
                    'septembertidakresmi',
                    'oktobertidakresmi',
                    'novembertidakresmi',
                    'desembertidakresmi',

                    'januaripenjelasan',
                    'februaripenjelasan',
                    'maretpenjelasan',
                    'aprilpenjelasan',
                    'meipenjelasan',
                    'junipenjelasan',
                    'julipenjelasan',
                    'agustuspenjelasan',
                    'septemberpenjelasan',
                    'oktoberpenjelasan',
                    'novemberpenjelasan',
                    'desemberpenjelasan',

                    'januaripm',
                    'februaripm',
                    'maretpm',
                    'aprilpm',
                    'meipm',
                    'junipm',
                    'julipm',
                    'agustuspm',
                    'septemberpm',
                    'oktoberpm',
                    'novemberpm',
                    'desemberpm',

                    'januariperundingan',
                    'februariperundingan',
                    'maretperundingan',
                    'aprilperundingan',
                    'meiperundingan',
                    'juniperundingan',
                    'juliperundingan',
                    'agustusperundingan',
                    'septemberperundingan',
                    'oktoberperundingan',
                    'novemberperundingan',
                    'desemberperundingan',

                    'januariterbuka',
                    'februariterbuka',
                    'maretterbuka',
                    'aprilterbuka',
                    'meiterbuka',
                    'juniterbuka',
                    'juliterbuka',
                    'agustusterbuka',
                    'septemberterbuka',
                    'oktoberterbuka',
                    'novemberterbuka',
                    'desemberterbuka',

                    'januaritertutup',
                    'februaritertutup',
                    'marettertutup',
                    'apriltertutup',
                    'meitertutup',
                    'junitertutup',
                    'julitertutup',
                    'agustustertutup',
                    'septembertertutup',
                    'oktobertertutup',
                    'novembertertutup',
                    'desembertertutup',

                    'notifikasi',
                    'count',
                ));
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
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            $cari = $request->cari;

            //bulan dan resmi
            $januariresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februariresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $maretresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $aprilresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meiresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juniresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juliresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustusresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktoberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desemberresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan tidak resmi
            $januaritidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februaritidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $marettidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $apriltidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $junitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $julitidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustustidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktobertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desembertidakresmi = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Tidak Resmi')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan penjelasan
            $januaripenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februaripenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $maretpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $aprilpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $junipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $julipenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustuspenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktoberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desemberpenjelasan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Penjelasan')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan pemecahan masalah
            $januaripm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februaripm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $maretpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $aprilpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $junipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $julipm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustuspm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktoberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desemberpm = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Pemecahan Masalah')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan perundingan
            $januariperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februariperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $maretperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $aprilperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meiperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juniperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juliperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustusperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktoberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desemberperundingan = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Perundingan')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan terbuka
            $januariterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februariterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $maretterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $aprilterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meiterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juniterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $juliterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustusterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktoberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desemberterbuka = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Terbuka')->where('tahun', 'like', "%" . $cari . "%")->count();

            //bulan dan tertutup
            $januaritertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '01')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $februaritertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '02')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $marettertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '03')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $apriltertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '04')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $meitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '05')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $junitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '06')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $julitertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '07')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $agustustertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '08')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $septembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '09')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $oktobertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '10')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $novembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '11')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();
            $desembertertutup = Agenda::orderBy('tanggal', 'asc')->where('bulan', '12')->where('jenis', 'Tertutup')->where('tahun', 'like', "%" . $cari . "%")->count();



            return view(
                'laporan.laporan_perbulan',
                compact(
                    'januariresmi',
                    'februariresmi',
                    'maretresmi',
                    'aprilresmi',
                    'meiresmi',
                    'juniresmi',
                    'juliresmi',
                    'agustusresmi',
                    'septemberresmi',
                    'oktoberresmi',
                    'novemberresmi',
                    'desemberresmi',

                    'januaritidakresmi',
                    'februaritidakresmi',
                    'marettidakresmi',
                    'apriltidakresmi',
                    'meitidakresmi',
                    'junitidakresmi',
                    'julitidakresmi',
                    'agustustidakresmi',
                    'septembertidakresmi',
                    'oktobertidakresmi',
                    'novembertidakresmi',
                    'desembertidakresmi',

                    'januaripenjelasan',
                    'februaripenjelasan',
                    'maretpenjelasan',
                    'aprilpenjelasan',
                    'meipenjelasan',
                    'junipenjelasan',
                    'julipenjelasan',
                    'agustuspenjelasan',
                    'septemberpenjelasan',
                    'oktoberpenjelasan',
                    'novemberpenjelasan',
                    'desemberpenjelasan',

                    'januaripm',
                    'februaripm',
                    'maretpm',
                    'aprilpm',
                    'meipm',
                    'junipm',
                    'julipm',
                    'agustuspm',
                    'septemberpm',
                    'oktoberpm',
                    'novemberpm',
                    'desemberpm',

                    'januariperundingan',
                    'februariperundingan',
                    'maretperundingan',
                    'aprilperundingan',
                    'meiperundingan',
                    'juniperundingan',
                    'juliperundingan',
                    'agustusperundingan',
                    'septemberperundingan',
                    'oktoberperundingan',
                    'novemberperundingan',
                    'desemberperundingan',

                    'januariterbuka',
                    'februariterbuka',
                    'maretterbuka',
                    'aprilterbuka',
                    'meiterbuka',
                    'juniterbuka',
                    'juliterbuka',
                    'agustusterbuka',
                    'septemberterbuka',
                    'oktoberterbuka',
                    'novemberterbuka',
                    'desemberterbuka',

                    'januaritertutup',
                    'februaritertutup',
                    'marettertutup',
                    'apriltertutup',
                    'meitertutup',
                    'junitertutup',
                    'julitertutup',
                    'agustustertutup',
                    'septembertertutup',
                    'oktobertertutup',
                    'novembertertutup',
                    'desembertertutup',

                    'notifikasi',
                    'count',
                )
            );
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
        return redirect('laporan-perbulan');
    }

    public function cari(Request $request)
    {

        $bulan = $request['bulan'];
        $jenis = $request['jenis'];


        if ($bulan == 'bulan' && $jenis == 'jenis') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        if ($bulan == 'bulan') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->where('jenis', $jenis)->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        if ($jenis == 'jenis') {
            $agenda = Agenda::orderBy('tanggal', 'desc')->where('bulan', $bulan)->get();
            $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
            return $pdf->stream();
        }

        $agenda = Agenda::orderBy('tanggal', 'desc')->where('jenis', $jenis)
            ->where('bulan', $bulan)
            ->get();

        $pdf = PDF::loadView('laporan.cetak_laporan', ['agenda' => $agenda]);
        return $pdf->stream();
    }


    public function destroy($id)
    {
        //
    }
}
