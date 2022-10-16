<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratIzinMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SuratIzinMPController extends Controller
{
    public function index(){
        $activeUser = request()->user();
        if($activeUser->hasRole('Admin')) {
            $users = User::with('department')->get();
            $suratIzinMP = SuratIzinMP::with('user', 'user.department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratIzinMP = SuratIzinMP::with('user', 'user.department', 'letterType')
                            ->join('users', function($join) {
                            $join->on('surat_izin_m_p_s.user_id', '=', 'users.id');
                            })
                            
            ->where('users.department_id',  $activeUser->department_id)->get(['surat_izin_m_p_s.id AS id_surat', 'surat_izin_m_p_s.*'])
            ;
        }

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


    public function edit($id){
        $activeUser = request()->user();
        
        $suratIzinMP = SuratIzinMP::find($id);
        if($activeUser->hasRole('Admin')){
            $izinMP = SuratIzinMP::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratIzinMP->user_id){
            $izinMP = SuratIzinMP::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        $berangkat = explode(' ', $izinMP->berangkat);
        $izinMP['berangkat_date'] = $berangkat[0];
        $izinMP['berangkat_time'] = $berangkat[1];

        $kembali = explode(' ', $izinMP->kembali);
        $izinMP['kembali_date'] = $kembali[0];
        $izinMP['kembali_time'] = $kembali[1];

        return view('surat_izin_mp.edit', compact('izinMP'));
    }

    public function update(Request $request, $id){

        $izinMP = SuratIzinMP::find($id);
        $userActive = request()->user();

        if(!$userActive->hasRole('Admin') && !($izinMP->user_id === $userActive->id)){
            abort(403);
        }

        $this->validate($request, [
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
        $izinMP->update($payload);

        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index')->with('success', 'Berhasil Memperbaruhi Form');
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

        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index')->with('success', 'Berhasil Menambahkan Form');
    }
    

    public function destroy($id){
        $suratIzinMP = SuratIzinMP::with('user', 'user.department')->find($id);
        
        File::delete(public_path($suratIzinMP->evidence)); // delete old files
        
        SuratIzinMP::find($id)->delete();

        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index')->with('success', 'Berhasil Menghapus Form');
    }

    public function download($id){
        $activeUser = request()->user();
        $suratIzinMP = SuratIzinMP::with('user')->find($id);
       
        if($activeUser->department_id !== $suratIzinMP->user->department_id || $activeUser->hasRole('Admin','Manager','Supervisor','Leader','Foreman', 'Operator')){
            abort(403);
        }

        $path = $suratIzinMP->evidence ? public_path($suratIzinMP->evidence) : null;
        
        if(File::exists($path)){
            $extension = explode('.', $path);
            
            $fileName = 'Surat Izin Meninggalkan Pekerjaan ' . $suratIzinMP->user->name . ' ' . $suratIzinMP->waktu . '.' . end($extension);
            return Response::download($path, $fileName);
        }
        return redirect()->route('letters.izin-meninggalkan-pekerjaan.index')->with('warning', 'File tidak ditemukan, Silahkan Upload Ulang File Evidence');

    }
}
