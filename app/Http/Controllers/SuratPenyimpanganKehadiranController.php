<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratPenyimpanganKehadiran;

class SuratPenyimpanganKehadiranController extends Controller
{
    public function index(){
        
        $activeUser = request()->user();
        if($activeUser->hasRole('Admin')) {
            $users = User::with('department')->get();
            $suratPenyimpanganKehadiran = SuratPenyimpanganKehadiran::with('user', 'user.department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratPenyimpanganKehadiran = SuratPenyimpanganKehadiran::with('user', 'user.department', 'letterType')
                            ->join('users', function($join) {
                            $join->on('surat_penyimpangan_kehadirans.user_id', '=', 'users.id');
                            })
                            
            ->where('users.department_id',  $activeUser->department_id)->get(['surat_penyimpangan_kehadirans.id AS id_surat', 'surat_penyimpangan_kehadirans.*'])
            ;
        }


        return view('surat_penyimpangan_kehadiran.index', compact('suratPenyimpanganKehadiran','users'));
    }

    public function edit($id){
        $activeUser = request()->user();
        
        $suratPenyimpanganKehadiran = SuratPenyimpanganKehadiran::find($id);
        if($activeUser->hasRole('Admin')){
            $penyimpanganKehadiran = SuratPenyimpanganKehadiran::with('user', 'user.department')->find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') || $activeUser->id == $suratPenyimpanganKehadiran->user_id){
            $penyimpanganKehadiran = SuratPenyimpanganKehadiran::with('user', 'user.department')->find($id);
        } else {
            abort(403);
        }

        return view('surat_penyimpangan_kehadiran.edit', compact('penyimpanganKehadiran'));

    }

    public function update(Request $request, $id){

        $penyimpanganKehadiran = SuratPenyimpanganKehadiran::find($id);
        $userActive = request()->user();

        if(!$userActive->hasRole('Admin') && !($penyimpanganKehadiran->user_id === $userActive->id)){
            abort(403);
        }

        $this->validate($request, [
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
    
        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $penyimpanganKehadiran->update($payload);

        return redirect()->route('letters.penyimpangan-kehadiran.index')->with('success', 'Berhasil Memperbaruhi Form');
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

        $payload = $request->all();

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['letter_type_id'] = 5;

        SuratPenyimpanganKehadiran::create($payload);
       
        return redirect()->route('letters.penyimpangan-kehadiran.index')->with('success', 'Berhasil Menambahkan Form');
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
}
