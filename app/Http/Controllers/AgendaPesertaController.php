<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\Notifikasi;
use Illuminate\Support\Facades\Auth;

class AgendaPesertaController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $nama = Auth::user()->nipy;
            $agenda = Agenda::where('peserta', 'like', "%" . $nama . "%")->get();
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();


            return view('agenda.agenda', compact('agenda', 'notifikasi', 'count'));
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


    public function show($id)
    {
        //
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
        return redirect('agenda-rapat');
    }


    public function destroy($id)
    {
        //
    }
}
