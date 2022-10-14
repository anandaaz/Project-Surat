<?php

namespace App\Http\Controllers;

use App\Models\SuratPertukaranHK;
use App\Models\User;
use Illuminate\Http\Request;

class SuratPertukaranHKController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPertukaranHK = SuratPertukaranHK::with('user', 'user.department', 'letterType')->paginate(10);
       

        return view('surat_pertukaran_h_k.index', compact('suratPertukaranHK','users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'section' => 'required',
            'cuti_start_date' => 'required',
            'cuti_end_date' => 'required',
            'kategori_cuti' => 'required',
            'saldo_cuti' => 'required',
            'catatan' => 'required',
            'keperluan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        $to = Carbon::parse($payload['cuti_start_date']);
        $from = Carbon::parse($payload['cuti_end_date']);

        $diff_in_days = $to->diffInDays($from);
        $payload['lama_cuti'] = $diff_in_days;
        $payload['letter_type_id'] = 4;

        SuratCuti::create($payload);

        return redirect()->route('surat-cuti.index');
    }
}
