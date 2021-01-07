<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifikasi;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nama = Auth::user()->nipy;
        $session_id = session()->getId();
        $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
        $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
     
        return view('home', compact('notifikasi', 'count', 'session_id'));
    }
}
