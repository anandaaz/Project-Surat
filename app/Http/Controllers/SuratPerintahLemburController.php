<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SuratPerintahLembur;

class SuratPerintahLemburController extends Controller
{
    public function index(){
        $users = User::with('department')->get();
        $suratPerintahLembur = SuratPerintahLembur::with('user', 'user.department', 'letterType')->paginate(10);

        return view('surat_perintah_kerja_lembur.index', compact('suratPerintahLembur','users'));
    }
}
