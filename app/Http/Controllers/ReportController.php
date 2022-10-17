<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\LetterType;
use App\Models\SuratCuti;
use App\Models\SuratIzinMP;
use App\Models\SuratPenyimpanganKehadiran;
use App\Models\SuratPerintahLembur;
use App\Models\SuratPermohonSCP;
use App\Models\SuratPertukaranHK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function filter($department = '%', $letterType = null){
        if($department == 0 || $department == '0'){
            $department = '%';
        }

        switch ($letterType) {
            case '1': // surat izin meninggalkan pekerjaan

                $forms = SuratIzinMP::leftJoin('users', function($join) {
                            $join->on('surat_izin_m_p_s.user_id', '=', 'users.id');
                         })->where('users.department_id', 'LIKE', $department)
                         ->where('surat_izin_m_p_s.evidence', '!=', 'null')
                         ->with('user.department')->orderBy('surat_izin_m_p_s.created_at', 'DESC')
                         ->paginate(20);
                break;

            case '2': // surat cuti / izin khusus
                
                $forms = SuratCuti::leftJoin('users', function($join) {
                            $join->on('surat_cutis.user_id', '=', 'users.id');
                         })->where('users.department_id', 'LIKE', $department)
                        ->where('surat_cutis.evidence', '!=', 'null')
                         ->with('user.department')->orderBy('surat_cutis.created_at', 'DESC')
                        ->paginate(20);
                break;
            case '3': // pertukaran hari kerja

                $forms = SuratPertukaranHK::leftJoin('users', function($join) {
                            $join->on('surat_pertukaran_h_k_s.user_id', '=', 'users.id');
                         })->where('users.department_id', 'LIKE', $department)
                         ->where('surat_pertukaran_h_k_s.evidence', '!=', 'null')
                          ->with('user.department')->orderBy('surat_pertukaran_h_k_s.created_at', 'DESC')
                         ->paginate(20);
                break;

            case '4': // permohonan saldo cuti pengganti

                $forms = SuratPermohonSCP::leftJoin('users', function($join) {
                            $join->on('surat_permohon_s_c_p_s.user_id', '=', 'users.id');
                         })->where('users.department_id', 'LIKE', $department)
                         ->where('surat_permohon_s_c_p_s.evidence', '!=', 'null')
                          ->with('user.department')->orderBy('surat_permohon_s_c_p_s.created_at', 'DESC')
                         ->paginate(20);
                break;

            case '5': // penyimpangan kehadiran

                $forms = SuratPenyimpanganKehadiran::leftJoin('users', function($join) {
                            $join->on('surat_penyimpangan_kehadirans.user_id', '=', 'users.id');
                         })->where('users.department_id', 'LIKE', $department)
                         ->where('surat_penyimpangan_kehadirans.evidence', '!=', 'null')
                          ->with('user.department')->orderBy('surat_penyimpangan_kehadirans.created_at', 'DESC')
                         ->paginate(20);
                break;

            case '6': // perintah kerja lembur

                $forms = SuratPerintahLembur::where('department_id', 'LIKE', $department)
                         ->where('surat_perintah_lemburs.evidence', '!=', 'null')
                          ->with('department')->orderBy('surat_perintah_lemburs.created_at', 'DESC')
                         ->paginate(20);
                break;

            default:
                if($department == null && ($letterType == null || $letterType > 6)){
                    // wajib pilih department atau letter type
                    $forms = array();
                } else {
                    $forms = array();
                }
                break;
        }

        $departments = Department::pluck('name', 'id')->all();
        $letterTypes = LetterType::pluck('name', 'id')->all();

        return view('reports.index', compact('forms', 'departments', 'letterTypes', 'department', 'letterType'));
    }

     //handle download file
     public function download(Request $request)
     {
        $path = $request->path;
        $fileName =  str_replace('/', '-',$path);
        $path = public_path($path);

        return Response::download($path, $fileName);
     }
}
