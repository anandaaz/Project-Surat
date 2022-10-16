<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratPermohonSCP;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SuratPermohonSCPController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPermohonSCP = SuratPermohonSCP::with('user', 'user.department', 'letterType')->paginate(10);
        
        $activeUser = request()->user();
        if($activeUser->hasRole('Admin')) {
            $users = User::with('department')->get();
            $suratPermohonSCP = SuratPermohonSCP::with('user', 'user.department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratPermohonSCP = SuratPermohonSCP::with('user', 'user.department', 'letterType')
                            ->join('users', function($join) {
                            $join->on('surat_permohon_s_c_p_s.user_id', '=', 'users.id');
                            })
                            
            ->where('users.department_id',  $activeUser->department_id)->get(['surat_permohon_s_c_p_s.id AS id_surat', 'surat_permohon_s_c_p_s.*'])
            ;
        }

        return view('surat_permohon_s_c_p.index', compact('suratPermohonSCP','users'));
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
        
        $suratPermohonanSCP = SuratPermohonSCP::find($id);
        if($activeUser->hasRole('Admin')){
            $permohonanSCP = SuratPermohonSCP::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratPermohonanSCP->user_id){
            $permohonanSCP = SuratPermohonSCP::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        return view('surat_permohon_s_c_p.edit', compact('permohonanSCP'));
    }  

    public function update(Request $request, $id){
        $permohonSCP = SuratPermohonSCP::find($id);
        $userActive = request()->user();

        if(!$userActive->hasRole('Admin') && !($permohonSCP->user_id === $userActive->id)){
            abort(403);
        }

        $this->validate($request, [
            'section' => 'required',
            'jumlah_hari' => 'required',
            'alasan' => 'required',
            'evidence' => 'mimes:pdf,docx|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['letter_type_id'] = 4; 
        $permohonSCP->update($payload);

        return redirect()->route('letters.permohonan-saldo-cuti-pengganti.index')->with('success', 'Berhasil Memperbaruhi Form');
    }         

    public function store(Request $request)
    {
        $this->validate($request, [
            'section' => 'required',
            'jumlah_hari' => 'required',
            'alasan' => 'required',
            'evidence' => 'mimes:pdf,docx|max:10240|nullable',
        ]);

        
        $payload = $request->all();
        $payload['letter_type_id'] = 4; 

        SuratPermohonSCP::create($payload);

        return redirect()->route('letters.permohonan-saldo-cuti-pengganti.index')->with('success', 'Berhasil Menambah Form');
    }

    public function download($id){
        $activeUser = request()->user();
        $suratPermohonSCP = SuratPermohonSCP::with('user')->find($id);
       
        if($activeUser->department_id !== $suratPermohonSCP->user->department_id || $activeUser->hasRole('Admin','Manager','Supervisor','Leader','Foreman', 'Operator')){
            abort(403);
        }

        $path = $suratPermohonSCP->evidence ? public_path($suratPermohonSCP->evidence) : null;
        
        if(File::exists($path)){
            $extension = explode('.', $path);
            
            $fileName = 'Surat Permohonan Saldo Cuti Pengganti ' . $suratPermohonSCP->user->name . ' ' . $suratPermohonSCP->waktu . '.' . end($extension);
            return Response::download($path, $fileName);
        }
        
        return redirect()->route('letters.permohonan-saldo-cuti-pengganti.index')->with('warning', 'File tidak ditemukan, Silahkan Upload Ulang File Evidence');

    }
}
