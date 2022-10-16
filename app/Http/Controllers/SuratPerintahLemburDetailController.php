<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SuratPerintahLembur;
use App\Models\SuratPerintahLemburDetail;

class SuratPerintahLemburDetailController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPerintahLembur = SuratPerintahLemburDetail::with('user', 'user.department', 'letterType')->paginate(10);

        return view('surat_perintah_kerja_lembur.index', compact('suratPerintahLembur','users'));
    }

    public function create($id){
        $activeUser = request()->user();
        
        if($activeUser->hasRole('Admin', 'Supervisor', "Foreman", "Leader", "Manager", "Operator")){
            $suratPerintahLembur = SuratPerintahLembur::with('surat_perintah_lembur_details', 'surat_perintah_lembur_details.user', 'department')->where('id', $id)->first();
            $users = User::where('department_id', $suratPerintahLembur->department_id)->get()->pluck('name', 'id');
            $departments = Department::pluck('name', 'id')->all();
        } else {
            $suratPerintahLembur = SuratPerintahLembur::with('surat_perintah_lembur_details', 'surat_perintah_lembur_details.user', 'department')->where('id', $id)->first();
            $users = User::where('department_id', $suratPerintahLembur->department_id)->get()->pluck('name', 'id');
            $departments = Department::where('id', $activeUser->department_id)->get()->pluck('name', 'id');
        }
        return view('surat_perintah_kerja_lembur.detail.create', compact('departments','users', 'suratPerintahLembur'));

    }

    public function edit($id){
        $activeUser = request()->user();
        
        if($activeUser->hasRole('Admin', 'Supervisor', "Foreman", "Leader", "Manager", "Operator")){
            $suratPerintahLembur = SuratPerintahLembur::with('surat_perintah_lembur_details', 'surat_perintah_lembur_details.user', 'department')->where('id', $id)->first();
            $users = User::where('department_id', $suratPerintahLembur->department_id)->get()->pluck('name', 'id');
            $departments = Department::pluck('name', 'id')->all();
        } else {
            $suratPerintahLembur = SuratPerintahLembur::with('surat_perintah_lembur_details', 'surat_perintah_lembur_details.user', 'department')->where('id', $id)->first();
            $users = User::where('department_id', $suratPerintahLembur->department_id)->get()->pluck('name', 'id');
            $departments = Department::where('id', $activeUser->department_id)->get()->pluck('name', 'id');
        }

        return view('surat_perintah_kerja_lembur.detail.create', compact('departments','users', 'suratPerintahLembur'));

    }

    public function show($id){
        $activeUser = request()->user();
        
        $suratPerintahLembur = SuratPerintahLembur::with('surat_perintah_lembur_details', 'surat_perintah_lembur_details.user', 'department')->where('id', $id)->first();

        return view('surat_perintah_kerja_lembur.detail.show', compact('suratPerintahLembur'));
    }

    public function store(Request $request, $suratPerintahLemburId){
        $this->validate($request, [
            'user_id' => 'required',
            'section' => 'required',
            'pekerjaan' => 'required',
            'jadwal_kerja_start' => 'required',
            'jadwal_kerja_to' => 'required',
            'rencana_lembur_start' => 'required',
            'rencana_lembur_to' => 'required',
            'aktual_lembur_start' => 'required',
            'aktual_lembur_to' => 'required',
        ]);

        $payload = $request->all();
        $payload['surat_perintah_lembur_id'] = $suratPerintahLemburId;
        
        // hitung total lembur
        $to = Carbon::parse($payload['aktual_lembur_start']);
        $from = Carbon::parse($payload['aktual_lembur_to']);
        
        $totalLembur = $to->diffInHours($from);
        $payload['jumlah_lembur'] = $totalLembur;
        $payload['personal_check_jml'] = $totalLembur;
        $payload['personal_check_tul'] = $totalLembur * 2;
        
        $suratPerintahLembur = SuratPerintahLembur::findOrFail($suratPerintahLemburId);
        
        $suratPerintahLembur->surat_perintah_lembur_details()->create(
            $payload
        );

        return redirect()->route('letters.perintah-kerja-lembur.create-detail', $suratPerintahLemburId)->with('message', 'Berhasil menambahkan data');
    }

    public function destroy($detailId, $suratPerintahLemburId) {
        SuratPerintahLemburDetail::find($detailId)->delete();
        return redirect()->route('letters.perintah-kerja-lembur.create-detail', $suratPerintahLemburId);
    }
}
