<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterType;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplyLetterController extends Controller
{
    public function create(Request $request, $departmentId){
        $payload = $this->validate($request, [
            'letter_type_id' => 'required',
        ]);

        $letterType = LetterType::find($payload['letter_type_id']);
        
        return view('letters.apply.create', compact('letterType'));
    }

    
    public function handleUploadFile($request)
    {
        $file = $request->file('file');
        $name = hexdec(uniqid()) . '-' . $request->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/evidence/'), $name);
        $path = 'uploads/evidence/' . $name;
        
        return $path;
    }
    
    public function apply(Request $request, $departmentId, $letterTypeId){
        $user = request()->user();
        $letterType = LetterType::find($letterTypeId);
        
        $payload = $this->validate($request, [
            'html' => 'required',
            'evidence' => 'mimes:pdf,docx|max:10250',
        ]);

        
        $payload = $request->all();
        $payload['name'] = $letterType->name;
        $payload['status'] = 'DRAFT';
        $payload['department_id'] = $departmentId;
        $payload['user_id'] = $user->id;
        $payload['letter_type_id'] = $letterTypeId;
        $payload['form'] = 'null';
        $payload['created_by'] = $user->id . '-' . $user->name;
        
        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }
        
        Letter::create($payload);
        
        return redirect()->route('letters.show', $departmentId);
    }

    public function edit(Request $request, $departmentId, $letterId){
        
        $letter = Letter::find($letterId);
        
        return view('letters.apply.edit', compact('letter'));
    }

    public function update(Request $request, $departmentId, $letterId){
        $user = request()->user();
        $letter = Letter::find($letterId);

        //check status letter
        if($letter->status !== 'DRAFT'){
            // jika bukan draft sudah tidak bisa edit form pengajuan
            return redirect()->route('letters.show', $departmentId);
        }

        $payload = $this->validate($request, [
            'html' => 'required',
            'evidence' => 'mimes:pdf,docx|max:10250',
        ]);

        $payload = $request->all();
        $payload['status'] = 'DRAFT';
        $payload['department_id'] = $departmentId;
        $payload['form'] = 'null';
        $payload['updated_at'] = NOW();
        $payload['updated_by'] = $user->id . '-' . $user->name;


        if (request()->hasFile('evidence')) {
            $path = $this->handleUploadFile($request);
            $payload['evidence'] = $path;
        }

        $letter->update($payload);

        return redirect()->route('letters.show', $departmentId);
    }

    public function uploadEvidence($departmentId, $letterId){
        // update letter by id
    }
}
