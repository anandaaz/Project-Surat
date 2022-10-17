<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\SuratPerintahLembur;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SuratPerintahLemburController extends Controller
{
    public function index(){
        $activeUser = request()->user();

        if($activeUser->hasRole('Admin')){
            $users = User::with('department')->get();
            $suratPerintahLembur = SuratPerintahLembur::with('created_by', 'department', 'letterType')->paginate(10);
        } else {
            $users = User::with('department')->where('department_id', $activeUser->department_id)->get();
            $suratPerintahLembur = SuratPerintahLembur::with('created_by', 'department', 'letterType')->where('department_id', $activeUser->department_id)->paginate(10);
        }

        return view('surat_perintah_kerja_lembur.index', compact('suratPerintahLembur','users'));
    }

    public function create(){
        $activeUser = request()->user();
        
        if($activeUser->hasRole('Admin')){
            $users = User::pluck('name', 'id')->all();
            $departments = Department::pluck('name', 'id')->all();
        } else {
            $users = User::where('department_id', $activeUser->department_id)->get()->pluck('name', 'id');
            $departments = Department::where('id', $activeUser->department_id)->get()->pluck('name', 'id');
        }
        
        return view('surat_perintah_kerja_lembur.create', compact('departments','users'));
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
        
        if($activeUser->hasRole('Admin')){
            $users = User::pluck('name', 'id')->all();
            $departments = Department::pluck('name', 'id')->all();
            $suratPerintahLembur = SuratPerintahLembur::find($id);
        } else if($activeUser->hasRole('Supervisor', 'Manager', 'Foreman', 'Leader', 'Operator') && $activeUser->department_id == $id){
            $users = User::pluck('name', 'id')->where('department_id', $activeUser->department_id)->get();
            $department = Department::where('id',$activeUser->department_id)->first()->pluck('name', 'id');
            $suratPerintahLembur = SuratPerintahLembur::find($id);
        } else {
            abort(403);
        }
        
        return view('surat_perintah_kerja_lembur.edit', compact('departments','users', 'suratPerintahLembur'));
    }

    public function store(Request $request){
        $activeUser = request()->user();

        $this->validate($request, [
            'waktu' => 'required',
            'department_id' => 'required',
            'evidence' => 'mimes:pdf,docx|max:10240|nullable',
        ]);
    
        $payload = $request->all();

        $payload['created_by'] = $activeUser->id;

        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $payload['letter_type_id'] = 6; 
        $suratPerintahLemburid = SuratPerintahLembur::create($payload);

        return redirect()->route('letters.perintah-kerja-lembur.create-detail', $suratPerintahLemburid);
    }

    public function download($id){
        $activeUser = request()->user();
        $suratPerintahLembur = SuratPerintahLembur::find($id);
        $suratPerintahLembur->load('department');

        if($activeUser->department_id !== $suratPerintahLembur->department_id){
            abort(403);
        }

        $path = $suratPerintahLembur->evidence ? public_path($suratPerintahLembur->evidence) : null;
        $fileName = 'Surat Perintah Lembur ' . $suratPerintahLembur->department->name . ' ' . $suratPerintahLembur->waktu;
        
        if(!File::exists($path)){
            return redirect()->route('letters.perintah-kerja-lembur.index')->with('warning', 'File tidak ditemukan, Silahkan Upload Ulang File Evidence');
        }

        return Response::download($path, $fileName);
    }
}
