<?php

namespace App\Http\Controllers;

use App\Models\LetterType;
use Illuminate\Http\Request;

class ApplyLetterController extends Controller
{
    public function checkTypeOfLetter(Request $request){
        $payload = $this->validate($request, [
            'letter_type_id' => 'required',
        ]);

        $letterType = LetterType::find($payload['letter_type_id']);
        
        return view('letters.apply.create', compact('letterType'));
        // switch ($letterType['id']) {
        //     case 1:
        //         // jenis lembur
        //         return $this->applyLembur();
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
    }

    public function applyLembur(){
        // $user = request()->user();
        return view('letters.apply.lembur', compact('user'));
    }
}
