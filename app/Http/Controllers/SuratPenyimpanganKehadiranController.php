<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratPenyimpanganKehadiran;

class SuratPenyimpanganKehadiranController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPenyimpanganKehadiran = SuratPenyimpanganKehadiran::with('user', 'user.department', 'letterType')->paginate(10);
        

        return view('surat_penyimpangan_kehadiran.index', compact('suratPenyimpanganKehadiran','users'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'section' => 'required',
            'jenis_penyimpangan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);

        switch ($request->jenis_penyimpangan) {
            case 'Pulang Lebih Awal':
                $this->validate($request, [
                    'jam_pulang' => 'required',
                ]);
                break;
            
            case 'Terlambat Hadir':
                $this->validate($request, [
                    'jam_masuk' => 'required',
                ]);
                break;
            
            case 'Tidak Absen':
                $this->validate($request, [
                    'jam_pulang' => 'required',
                    'jam_masuk' => 'required',
                ]);
                break;
        }

       
        dd($request);
    }
}
