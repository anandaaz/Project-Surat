<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\LetterType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $letterTypes = LetterType::paginate(10);
        $departments = Department::all();
        return view('letter-types.index',compact('letterTypes', 'departments'));
    }

    public function show($id){
        $department = Department::find($id);
        $letterTypes = LetterType::with('user', 'user.roles')->where('department_id', $id)->paginate(10);

        return view('letter-types.show', compact('letterTypes', 'department'));
    }

    // handle upload file

    public function handleUploadFile($request)
    {
        $file = $request->file('file');
        $name = hexdec(uniqid()) . '-' . $request->name . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/softcopy/'), $name);
        $path = 'uploads/softcopy/' . $name;

        return $path;
    }

    public function create($departmentId){
        $department = Department::find($departmentId);
        return view('letter-types.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $payload = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'html' => 'required',
            'department_id' => 'required'
        ]);
        
        if (request()->hasFile('file')) {
            $path = $this->handleUploadFile($request);
            $payload['file_path'] = $path;
        }

        $payload['user_id'] = $request->user()->id;

        LetterType::create($payload);
    
        return redirect()->route('letter-types.show', $payload['department_id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $letterType = LetterType::find($id);
    
        return view('letter-types.edit',compact('letterType'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'html' => 'required',
        ]);

        $letterType = LetterType::with('department')->find($id);
        $payload['file_path'] = $letterType->file_path;
        
        if (request()->hasFile('file')) {
            File::delete(public_path($letterType->file_path)); // delete old files

            $path = $this->handleUploadFile($request);
            $payload['file_path'] = $path;
        }

        $payload['user_id'] = $request->user()->id;
        $letterType->update($payload);
        
        return redirect()->route('letter-types.show', $letterType->department->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $letterType = LetterType::with('department')->find($id);
        $departmentId = $letterType->department->id;
        File::delete(public_path($letterType->file_path)); // delete old files
        LetterType::find($id)->delete();
        return redirect()->route('letter-types.show', $departmentId);
    }

    //handle download file
    public function download($id)
    {
        $letterType = LetterType::find($id);
    	$path = public_path($letterType->file_path);
    	$fileName = $letterType->name;

    	return Response::download($path, $fileName);
    }

    public function test(){
        return view('layouts.ckeditor');
    }




    public function handleUploadImageCKEditor(Request $request){
        if (request()->hasFile('file')) {
            $path = $this->handleUploadFile($request);
            
        }

        return $path;
    }


}
