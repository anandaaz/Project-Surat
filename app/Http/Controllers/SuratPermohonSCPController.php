<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratPermohonSCP;

class SuratPermohonSCPController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPermohonSCP = SuratPermohonSCP::with('user', 'user.department', 'letterType')->paginate(10);
        
        return view('surat_permohon_s_c_p.index', compact('suratPermohonSCP','users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'section' => 'required',
            'berangkat_date' => 'required',
            'berangkat_date' => 'required',
            'kembali_time' => 'required',
            'kembali_time' => 'required',
            'keperluan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        $payload['berangkat'] = $payload['berangkat_date'] . ' ' . $payload['berangkat_time'];
        $payload['kembali'] = $payload['kembali_date'] . ' ' . $payload['kembali_time'];

        SuratIzinMP::create($payload);

        return redirect()->route('surat_izin_mp.index');
    }
}
