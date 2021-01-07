<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use SweetAlert;

class AkunController extends Controller
{

    public function index()
    {
        $users = User::orderBy('nipy', 'asc')->paginate(10);
        return view('admin.akun.akun', compact('users'));
    }


    public function create()
    {
        return view('admin.akun.tambah_akun');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nipy' => ['required', 'string', 'max:10', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        ]);
    }

    

    protected function validatorEmail(array $data)
    {
        return Validator::make($data, [

            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        ]);
    }

    protected function validatorNIPY(array $data)
    {
        return Validator::make($data, [
            'nipy' => ['required', 'string', 'max:10', 'unique:users'],

        ]);
    }

    protected function validatorReset(array $data)
    {
        return Validator::make($data, [
            'password' => ['string', 'min:8'],
        ]);
    }



    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $nama = '';
        $admin = User::create([
            'nipy' => $request['nipy'],
            'email' => $request['email'],
            'password' => Hash::make($request['nipy']),
            'nama' => $nama,
        ]);

        return redirect('akun-peserta')->with('tambah', 'Data telah ditambahkan!');
    }


    public function show(Request $request)
    {
        $cari = $request->cari;
        $users = User::orderBy('nipy', 'asc')->where('nipy', 'like', "%" . $cari . "%")
            ->orwhere('email', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('admin.akun.akun', compact('users'));
    }


    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.akun.sunting_akun', compact('users'));
    }


    public function update(Request $request, $id)
    {

        $ambiluser = User::where('id', $id)->first();
        $ambilemail = $ambiluser['email'];
        $ambilnipy = $ambiluser['nipy'];
        $emailmasuk = $request['email'];
        $nipymasuk = $request['nipy'];

        if ($ambilemail == $emailmasuk && $ambilnipy == $nipymasuk) {
            return redirect('akun-peserta')->with('sunting', 'Data telah diubah!');
        }

        if ($ambilemail == $emailmasuk) {
            $this->validatorNIPY($request->all())->validate();
            $admin = User::whereId($id)->update([
                'nipy' => $request['nipy'],
            ]);
            return redirect('akun-peserta')->with('sunting', 'Data telah diubah!');
        }

        if ($ambilnipy == $nipymasuk) {
            $this->validatorEmail($request->all())->validate();
            $admin = User::whereId($id)->update([
                'email' => $request['email'],
            ]);
            return redirect('akun-peserta')->with('sunting', 'Data telah diubah!');
        }
        $this->validator($request->all())->validate();
        $admin = User::whereId($id)->update([
            'nipy' => $request['nipy'],
            'email' => $request['email'],

        ]);
        return redirect('akun-peserta')->with('sunting', 'Data telah diubah!');
    }


    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('akun-peserta')->with('hapus', 'Data telah dihapus!');
    }

    public function reset(Request $request, $id)
    {
        $this->validatorReset($request->all())->validate();
        $nipy = User::where('id', $request['id'])->get('nipy');
        $admin = User::whereId($id)->update([
            'password' => Hash::make($nipy[0]['nipy']),
        ]);
        return redirect('akun-peserta')->with('reset', 'Kata sandi telah diubah!');
    }
}
