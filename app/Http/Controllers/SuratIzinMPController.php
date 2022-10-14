<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratIzinMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SuratIzinMPController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratIzinMP = SuratIzinMP::with('user', 'user.department', 'letterType')->paginate(10);
        
        return view('surat_izin_mp.index', compact('suratIzinMP','users'));
    }

     public function handleUploadFile($request)
    {
        $user = request()->user();
        $file = $request->file('evidence');
        $name = hexdec(uniqid()) . '-' . $user->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/softcopy/'), $name);
        $path = 'uploads/softcopy/' . $name;

        return $path;
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
            'evidence' => 'mimes:pdf,docx|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['berangkat'] = $payload['berangkat_date'] . ' ' . $payload['berangkat_time'];
        $payload['kembali'] = $payload['kembali_date'] . ' ' . $payload['kembali_time'];

        $payload['letter_type_id'] = 1; 
        SuratIzinMP::create($payload);

        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index');
    }
    
    public function uploadEvidence(Request $request){
        //
    }

    public function destroy($id){
        $suratIzinMP = SuratIzinMP::with('user', 'user.department')->find($id);
        
        File::delete(public_path($suratIzinMP->evidence)); // delete old files
        SuratIzinMP::find($id)->delete();

        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index');
    }
}
