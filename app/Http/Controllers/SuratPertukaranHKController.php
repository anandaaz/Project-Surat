<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SuratPertukaranHK;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SuratPertukaranHKController extends Controller
{
    public function index(){
        $activeUser = request()->user();
        if($activeUser->hasRole('Admin')) {
            $users = User::with('department')->get();
            $suratPertukaranHK = SuratPertukaranHK::with('user', 'user.department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratPertukaranHK = SuratPertukaranHK::with('user', 'user.department', 'letterType')
                            ->join('users', function($join) {
                            $join->on('surat_pertukaran_h_k_s.user_id', '=', 'users.id');
                            })
            ->where('users.department_id',  $activeUser->department_id)->get(['surat_pertukaran_h_k_s.id AS id_surat', 'surat_pertukaran_h_k_s.*'])
            ;
        }
        return view('surat_pertukaran_h_k.index', compact('suratPertukaranHK','users'));
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
        
        $suratPertukaranHK = SuratPertukaranHK::find($id);
        if($activeUser->hasRole('Admin')){
            $pertukaranHK = SuratpertukaranHK::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratPertukaranHK->user_id){
            $pertukaranHK = SuratPertukaranHK::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        return view('surat_pertukaran_h_k.edit', compact('pertukaranHK'));
    }

    public function update(Request $request, $id){
        $pertukaranHK = SuratPertukaranHK::findOrFail($id);
        $userActive = request()->user();

        if(!$userActive->hasRole('Admin') && !($pertukaranHK->user_id === $userActive->id)){
            abort(403);
        }

        $this->validate($request, [
            'section' => 'required',
            'tanggal_kerja_start_date' => 'required',
            'tanggal_kerja_end_date' => 'required',
            'jam_kerja_start_time' => 'required',
            'jam_kerja_end_time' => 'required',
            'jumlah_kerja' => 'required',
            'kondisi_kerja' => 'required',
            'tanggal_pertukaran_start_date' => 'required',
            'tanggal_pertukaran_end_date' => 'required',
            'jam_pertukaran_start_time' => 'required',
            'jam_pertukaran_end_time' => 'required',
            'alasan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['letter_type_id'] = 3;

        $pertukaranHK->update($payload);

        return redirect()->route('letters.pertukaran-hari-kerja.index')->with('success', 'Berhasil memperbaharui form');
    }

    public function show($id){
        $activeUser = request()->user();
        
        $suratPertukaranHK = SuratPertukaranHK::find($id);
        if($activeUser->hasRole('Admin')){
            $pertukaranHK = SuratpertukaranHK::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratPertukaranHK->user_id){
            $pertukaranHK = SuratPertukaranHK::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        return view('surat_pertukaran_h_k.show', compact('pertukaranHK'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'section' => 'required',
            'tanggal_kerja_start_date' => 'required',
            'tanggal_kerja_end_date' => 'required',
            'jam_kerja_start_time' => 'required',
            'jam_kerja_end_time' => 'required',
            'jumlah_kerja' => 'required',
            'kondisi_kerja' => 'required',
            'tanggal_pertukaran_start_date' => 'required',
            'tanggal_pertukaran_end_date' => 'required',
            'jam_pertukaran_start_time' => 'required',
            'jam_pertukaran_end_time' => 'required',
            'alasan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['letter_type_id'] = 3;

        SuratPertukaranHK::create($payload);

        return redirect()->route('letters.pertukaran-hari-kerja.index')->with('success', 'Berhasil menambahkan form');
    }

    public function destroy($id){
        $suratPertukaranHK = SuratPertukaranHK::with('user', 'user.department')->find($id);
        
        File::delete(public_path($suratPertukaranHK->evidence)); // delete old files
        
        SuratPertukaranHK::find($id)->delete();

        return redirect()->route('letters.pertukaran-hari-kerja.index')->with('success', 'Berhasil Menghapus Form');
    }

    public function download($id){
        $activeUser = request()->user();
        $suratPertukaranHK = SuratPertukaranHK::with('user')->find($id);
       
        if($activeUser->department_id !== $suratPertukaranHK->user->department_id || $activeUser->hasRole('Admin','Manager','Supervisor','Leader','Foreman', 'Operator')){
            abort(403);
        }

        $path = $suratPertukaranHK->evidence ? public_path($suratPertukaranHK->evidence) : null;
        
        if(File::exists($path)){
            $extension = explode('.', $path);
            
            $fileName = 'Surat Pertukaran Hari kerja ' . $suratPertukaranHK->user->name . ' ' . $suratPertukaranHK->waktu . '.' . end($extension);
            return Response::download($path, $fileName);
        }
        return redirect()->route('letters.pertukaran-hari-kerja.index')->with('warning', 'File tidak ditemukan, Silahkan Upload Ulang File Evidence');

    }
}
