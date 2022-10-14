<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratCuti;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class SuratCutiController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratCuti = SuratCuti::with('user', 'user.department', 'letterType')->paginate(10);
        $kategoriCuti = array(
            'Cuti Tahunan' =>  'Cuti Tahunan',
            'Cuti 5 Tahunan' => 'Cuti 5 Tahunan',
            'Cuti Pengganti' => 'Cuti Pengganti',
            'Cuti Haid' => 'Cuti Haid',
            'Cuti Melahirkan' => 'Cuti Melahirkan',
            'Cuti Menikah' => 'Cuti Menikah',
        );

        return view('surat_cuti.index', compact('suratCuti','users', 'kategoriCuti'));
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

        return redirect()->route('letters.cuti.index');
    }

    public function uploadEvidence(Request $request){
        //
    }

    public function destroy($id){
        $suratCuti = SuratCuti::with('user', 'user.department')->find($id);
        
        File::delete(public_path($suratCuti->evidence)); // delete old files
        SuratCuti::find($id)->delete();

        return redirect()->route('letters.cuti.index');
    }
}
