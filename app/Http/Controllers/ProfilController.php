<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Notifikasi;

use function Ramsey\Uuid\v1;

class ProfilController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $id = Auth::user()->nipy;
            $peserta = Peserta::where('nipy', $id)->first();
            $users = User::where('nipy', $id)->first();

            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            return view('profil.profil', compact('peserta', 'users', 'notifikasi', 'count'));
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
    }


    public function edit($id)
    {
        if (Auth::check()) {
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            $peserta = Peserta::find($id);
            return view('profil.sunting_profil', compact('peserta', 'notifikasi', 'count'));
        }
        return view('welcome');
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:40'],
            'status' => ['required', 'string', 'max:40'],
            'jabatan' => ['required', 'string', 'max:40'],
            'pendidikan' => ['required', 'string',],
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->validatorUpdate($request->all())->validate();
        $admin = Peserta::whereId($id)->update([
            'nama' => $request['nama'],
            'status' => $request['status'],
            'jabatan' => $request['jabatan'],
            'pendidikan' => $request['pendidikan'],
        ]);

        $peserta = Peserta::where('id', $id)->get('nipy');
        $nipy = $peserta[0]['nipy'];

        $admin = User::where('nipy', $nipy)->update([
            'nama' => $request['nama'],
        ]);

        return redirect('profil')->with('sunting', 'Data telah diubah!');
    }

    protected function validatorFoto(array $data)
    {
        return Validator::make($data, [
            'foto' => ['required', 'max:2048', 'file', 'image', 'mimes:jpeg,png,jpg'],
        ]);
    }

    public function editFoto(Request $request, $id)
    {
        $this->validatorFoto($request->all())->validate();

        $imageName = time() . '.' . $request->foto->extension();

        $request->foto->move(public_path('images'), $imageName);
        $admin = Peserta::whereId($id)->update([
            'foto' => $imageName,
        ]);
        return redirect('profil')->with('sunting', 'Data telah diubah!')->with('foto', $imageName);
    }

    public function destroy($id)
    {
        //
    }
}
