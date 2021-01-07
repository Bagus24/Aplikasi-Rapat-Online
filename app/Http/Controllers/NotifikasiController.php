<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifikasi;

class NotifikasiController extends Controller
{

    public function index()
    {
        //
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
        return redirect('home')->with('notifikasi', 'Notifikasi telah ditandai!');
    }


    public function destroy($id)
    {
        //
    }
}
