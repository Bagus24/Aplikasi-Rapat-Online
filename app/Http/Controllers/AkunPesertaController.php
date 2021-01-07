<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Notifikasi;
use Illuminate\Support\Facades\Hash;
use Auth;

class AkunPesertaController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();

            return view('akun.akun', compact('notifikasi', 'count'));
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

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validatorKatasandi(array $data)
    {
        return Validator::make($data, [

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $ambilemail = Auth::user()->email;
        $email = $request['email'];

        if ($ambilemail == $email) {
            $this->validatorKatasandi($request->all())->validate();
            $admin = User::whereId($id)->update([
                'password' => Hash::make($request['password']),
            ]);
            return redirect('home')->with('sunting', 'Data telah diubah!');
        }


        $this->validatorUpdate($request->all())->validate();
        $admin = User::whereId($id)->update([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('home')->with('sunting', 'Data telah diubah!');
    }


    public function destroy($id)
    {
        //
    }
}
