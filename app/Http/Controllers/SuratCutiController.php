<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratCuti;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SuratCutiController extends Controller
{
    public function index(){
        $activeUser = request()->user();

        if($activeUser->hasRole('Admin')) {
            $users = User::with('department')->get();
            $suratCuti = SuratCuti::with('user', 'user.department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratCuti = SuratCuti::with('user', 'user.department', 'letterType')
                            ->join('users', function($join) {
                            $join->on('surat_cutis.user_id', '=', 'users.id');
                            })
                            ->where('users.department_id',  $activeUser->department_id)->get(['surat_cutis.id AS id_surat', 'surat_cutis.*'])
            ;
        }

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

    public function edit($id){
        $activeUser = request()->user();
        
        $suratCuti = SuratCuti::findOrFail($id);
        
        if($activeUser->hasRole('Admin')){
            $cuti = SuratCuti::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratCuti->user_id){
            $cuti = SuratCuti::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        $kategoriCuti = array(
            'Cuti Tahunan' =>  'Cuti Tahunan',
            'Cuti 5 Tahunan' => 'Cuti 5 Tahunan',
            'Cuti Pengganti' => 'Cuti Pengganti',
            'Cuti Haid' => 'Cuti Haid',
            'Cuti Melahirkan' => 'Cuti Melahirkan',
            'Cuti Menikah' => 'Cuti Menikah',
        );

        return view('surat_cuti.edit', compact('cuti', 'kategoriCuti'));
    }

    public function update(Request $request, $id){
        
        $suratCuti = SuratCuti::find($id);

        $this->validate($request, [
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

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $to = Carbon::parse($payload['cuti_start_date']);
        $from = Carbon::parse($payload['cuti_end_date']);

        $diff_in_days = $to->diffInDays($from);
        $payload['lama_cuti'] = $diff_in_days;
        $payload['letter_type_id'] = 4;

        $suratCuti->update($payload);

        return redirect()->route('letters.cuti.index')->with('success', 'Berhasil Memperbaruhi Form');
    }

    public function handleUploadFile($request) {
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
            'cuti_start_date' => 'required',
            'cuti_end_date' => 'required',
            'kategori_cuti' => 'required',
            'saldo_cuti' => 'required',
            'catatan' => 'required',
            'keperluan' => 'required',
            'evidence' => 'mimes:pdf|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $to = Carbon::parse($payload['cuti_start_date']);
        $from = Carbon::parse($payload['cuti_end_date']);

        $diff_in_days = $to->diffInDays($from);
        $payload['lama_cuti'] = $diff_in_days;
        $payload['letter_type_id'] = 4;

        SuratCuti::create($payload);

        return redirect()->route('letters.cuti.index')->with('success', 'Berhasil Menambah Form');
    }


    public function destroy($id){
        $suratCuti = SuratCuti::with('user', 'user.department')->find($id);
        
        File::delete(public_path($suratCuti->evidence)); // delete old files
        SuratCuti::find($id)->delete();

        return redirect()->route('letters.cuti.index')->with('success', 'Berhasil Menghapus Form');
    }

    public function download($id){
        $activeUser = request()->user();
        $suratCuti = SuratCuti::with('user')->find($id);
        
        if(($activeUser->department_id !== $suratCuti->user->department_id) && $activeUser->hasRole('Admin','Manager','Supervisor','Leader','Foreman', 'Operator')){
            abort(403);
        }
        $path = $suratCuti->evidence ? public_path($suratCuti->evidence) : null;
        
        if(File::exists($path)){
            $extension = explode('.', $path);
            
            $fileName = 'Surat Cuti / Izin Khusus' . $suratCuti->user->name . ' ' . $suratCuti->waktu . '.' . end($extension);
            return Response::download($path, $fileName);
        }

        return redirect()->route('letters.cuti.index')->with('warning', 'File tidak ditemukan, Silahkan Upload Ulang File Evidence');

    }
}
