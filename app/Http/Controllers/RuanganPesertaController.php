<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Agenda;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Auth;
use App\Message;
use App\Events\MessageSent;
use App\Notifikasi;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RuanganPesertaController extends Controller
{
    protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            $sid    = "ACc716d31f27686eda7387151b810bd6b9";
            $token  = "73beadc83724799544669d1d659192b4";
            $key = "SK31325090e8f25262d78496821cbe8872";
            $secret = "lUJtKje4kKDlBBKcqFRADk1t55erqJxi";
            $ruangan = Ruangan::orderBy('kode', 'asc')->paginate(10);
            $rooms = [];
            try {
                $client = new Client($sid, $token);
                $allRooms = $client->video->rooms->read([]);

                $rooms = array_map(function ($room) {
                    return $room->uniqueName;
                }, $allRooms);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            return view('ruangan.ruangan', ['rooms' => $rooms], compact('ruangan', 'notifikasi', 'count'));
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
            $sid    = "ACc716d31f27686eda7387151b810bd6b9";
            $token  = "73beadc83724799544669d1d659192b4";
            $key = "SK31325090e8f25262d78496821cbe8872";
            $secret = "lUJtKje4kKDlBBKcqFRADk1t55erqJxi";
            $cari = $request->cari;
            $ruangan = Ruangan::orderBy('kode', 'desc')->where('kode', 'like', "%" . $cari . "%")
                ->paginate(10);

            $rooms = [];
            try {
                $client = new Client($sid, $token);
                $allRooms = $client->video->rooms->read([]);

                $rooms = array_map(function ($room) {
                    return $room->uniqueName;
                }, $allRooms);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            $nama = Auth::user()->nipy;
            $notifikasi = Notifikasi::orderBy('id', 'desc')->where('nama_peserta', $nama)->paginate(10);
            $count = Notifikasi::where('nama_peserta', $nama)->where('status', 'baru')->count();
            return view('ruangan.ruangan', ['rooms' => $rooms], compact('ruangan', 'notifikasi', 'count'));
        }
        return view('welcome');
    }


    public function joinRoom($kode)
    {

        if (Auth::check()) {
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date("yy-m-d");
            $waktu = date("H:i");
            $agenda = Agenda::where('kode', $kode)->first();
            $tanggal_rapat = $agenda['tanggal'];
            $waktu_mulai = $agenda['mulai'];
            $waktu_selesai = $agenda['selesai'];
            $peserta = $agenda['peserta'];
            $explode = explode(" | ", $peserta);
            $nipy = Auth::user()->nipy;
            $hasilval = '';

            if ($tanggal != $tanggal_rapat) {
                return redirect('ruangan-rapat')->with('errortanggal', 'Mohon lihat jadwal kembali!');
            }

            if ($waktu < $waktu_mulai) {
                return redirect('ruangan-rapat')->with('errormulai', 'Rapat belum dimulai!');
            }

            if ($waktu > $waktu_selesai) {
                return redirect('ruangan-rapat')->with('errorselesai', 'Rapat sudah selesai!');
            }

            if (in_array($nipy, $explode)) {
                $hasilval = 'ada yang sama';
            } else {
                $hasilval =  'gagal';
            }

            if ($hasilval == 'gagal') {
                return redirect('ruangan-rapat')->with('errorpeserta', 'Anda tidak terdaftar dalam rapat!');
            } else {

                $sid    = "ACc716d31f27686eda7387151b810bd6b9";
                $token  = "73beadc83724799544669d1d659192b4";
                $key = "SK31325090e8f25262d78496821cbe8872";
                $secret = "lUJtKje4kKDlBBKcqFRADk1t55erqJxi";
                $identity = Auth::user()->nipy;

                \Log::debug("joined with identity: $identity");
                $token = new AccessToken($sid, $key, $secret, 3600, $identity);

                $videoGrant = new VideoGrant();
                $videoGrant->setRoom($kode);

                $token->addGrant($videoGrant);

                return view('chat', ['accessToken' => $token->toJWT(), 'kode' => $kode]);
            }
        }
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function fetchMessages()
    {
        return Message::with('users')->get();
    }


    public function sendMessage(Request $request)
    {
        $user = Auth::user();


        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
        ]);



        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
