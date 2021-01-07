<?php

namespace App\Http\Controllers;

use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class RuanganController extends Controller
{
    protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function index()
    {
        $ruangan = Ruangan::orderBy('kode', 'asc')->paginate(10);
        return view('admin.ruangan.ruangan', compact('ruangan'));
    }

    public function create()
    {
        return view('admin.ruangan.buat_ruangan');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'kode' => ['required', 'string', 'max:12', 'unique:ruangan'],
        ]);
    }
    public function store(Request $request)
    {
        $sid    = "ACc716d31f27686eda7387151b810bd6b9";
        $token  = "73beadc83724799544669d1d659192b4";
        $key = "SK31325090e8f25262d78496821cbe8872";
        $secret = "lUJtKje4kKDlBBKcqFRADk1t55erqJxi";
        $this->validator($request->all())->validate();
        $client = new Client($sid, $token);
        $exists = $client->video->rooms->read(['uniqueName' => $request->kode]);

        $admin = Ruangan::create([
            'kode' => $request['kode'],

        ]);

        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->kode,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);

            \Log::debug("created new room: " . $request->kode);
        }

        return redirect('ruangan')->with('tambah', 'Data telah ditambahkan!');
    }


    public function show(Request $request)
    {
        $cari = $request->cari;
        $ruangan = Ruangan::orderBy('kode', 'asc')
            ->orwhere('kode', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('admin.ruangan.ruangan', compact('ruangan'));
    }


    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('admin.ruangan.sunting_ruangan', compact('ruangan'));
    }


    public function update(Request $request, $id)
    {
        $ambilruangan = Ruangan::where('id', $id)->first();
        $ambilkode = $ambilruangan['kode'];

        if ($ambilkode == $request['kode']) {
            return redirect('ruangan')->with('sunting', 'Data telah diubah!');
        }

        $sid    = "ACc716d31f27686eda7387151b810bd6b9";
        $token  = "73beadc83724799544669d1d659192b4";
        $key = "SK31325090e8f25262d78496821cbe8872";
        $secret = "lUJtKje4kKDlBBKcqFRADk1t55erqJxi";
        $client = new Client($sid, $token);
        $exists = $client->video->rooms->read(['uniqueName' => $request->kode]);
        $this->validator($request->all())->validate();
        $admin = Ruangan::whereId($id)->update([
            'kode' => $request['kode'],

        ]);
        if (empty($exists)) {
            $client->video->rooms->create([
                'uniqueName' => $request->kode,
                'type' => 'group',
                'recordParticipantsOnConnect' => false
            ]);

            \Log::debug("created new room: " . $request->kode);
        }
        return redirect('ruangan')->with('sunting', 'Data telah diubah!');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        return redirect('ruangan')->with('hapus', 'Data telah dihapus!');
    }
}
