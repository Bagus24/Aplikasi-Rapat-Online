<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    
    public function index()
    {
        $peserta = Peserta::orderBy('nama', 'asc')->paginate(10);
        return view('admin.peserta.peserta', compact('peserta'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.peserta.tambah_peserta', compact('users'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nipy' => ['required', 'string', 'max:10', 'unique:pesertas'],
            'nama' => ['required', 'string', 'max:40',],
            'status' => ['required', 'string', 'max:40'],
            'jabatan' => ['required', 'string', 'max:40'],
            'pendidikan' => ['required',],
            'foto' => ['required', 'max:2048', 'file','image','mimes:jpeg,png,jpg' ],
        ]);
    }

    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:40'],
            'status' => ['required', 'string', 'max:40'],
            'jabatan' => ['required', 'string', 'max:40'],
            'pendidikan' => ['required',],
        ]);
    }

    protected function validatorFoto(array $data)
    {
        return Validator::make($data, [
            'foto' => ['required', 'max:2048', 'file','image','mimes:jpeg,png,jpg' ],
        ]);
    }

    public function editFoto(Request $request, $id){
        $this->validatorFoto($request->all())->validate();

        $imageName = time().'.'.$request->foto->extension();  
   
        $request->foto->move(public_path('images'), $imageName);
        $admin = Peserta::whereId($id)->update([
            'foto' => $imageName,
        ]);
        return redirect('peserta')->with('sunting', 'Data telah diubah!')->with('foto',$imageName);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $imageName = time().'.'.$request->foto->extension();  
   
        $request->foto->move(public_path('images'), $imageName);

        $id = User::where('nipy', $request['nipy'])->get('id');
        $admin = Peserta::create([
            'nipy' => $request['nipy'],
            'nama' => $request['nama'],
            'status' => $request['status'],
            'jabatan' => $request['jabatan'],
            'pendidikan' => $request['pendidikan'],
            'foto' => $imageName,
        ]);
        
        $admin = User::where('nipy', $request['nipy'])->update([
            'nama' => $request['nama'],
        ]);
        return redirect('peserta')->with('tambah', 'Data telah ditambahkan!');
        
        
    }
    
    public function show(Request $request)
    {
        $cari = $request->cari;
        $peserta = Peserta::orderBy('nama', 'asc')->where('nama', 'like', "%" . $cari . "%")
            ->orwhere('nipy', 'like', "%" . $cari . "%")
            ->orwhere('status', 'like', "%" . $cari . "%")
            ->orwhere('jabatan', 'like', "%" . $cari . "%")
            ->orwhere('pendidikan', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('admin.peserta.peserta', compact('peserta'));
    }

    
    public function edit($id)
    {
        $peserta = Peserta::find($id);
        return view('admin.peserta.sunting_peserta', compact('peserta'));
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
        
        return redirect('peserta')->with('sunting', 'Data telah diubah!');
    }

    
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();
        return redirect('peserta')->with('hapus', 'Data telah dihapus!');
    }
}