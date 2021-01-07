<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::where('id', $id)->first();
        return view('admin.admin.sunting_admin', compact('admin'));
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
            'name' => ['required', 'string', 'max:40'],
            'username' => ['required', 'string', 'max:20'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validatorUpdate($request->all())->validate();
        $admin = Admin::whereId($id)->update([
            'name' => $request['name'],
            'username' => $request['username'],
            
        ]);
        return redirect('home/admin')->with('sunting', 'Data telah diubah!');
    }

    public function destroy($id)
    {
        //
    }

    protected function validatorKatasandi(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function gantiKatasandi (Request $request, $id) 
    {
        $this->validatorKatasandi($request->all())->validate();
        $admin = Admin::whereId($id)->update([
            'password' => Hash::make($request['password']),
        ]);
        return redirect('home/admin')->with('sunting', 'Data telah diubah!');
    }
}
