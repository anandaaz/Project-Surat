<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuratCutiController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\ApplyLetterController;
use App\Http\Controllers\SuratIzinMPController;
use App\Http\Controllers\SuratPermohonSCPController;
use App\Http\Controllers\SuratPertukaranHKController;
use App\Http\Controllers\SuratPerintahLemburController;
use App\Http\Controllers\SuratPenyimpanganKehadiranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class); // auto generate route get, show, post, patch/put, delete route
    Route::resource('users', UserController::class);
    Route::post('users/change-password/{id}', [UserController::class, 'changePassword'])->name('auth.update');
    
    Route::resource('departments', DepartmentController::class);
    Route::delete('departments/remove/{userID}', [DepartmentController::class, 'removeUser'])->name('departments.remove.user');
    
    Route::resource('letter-types', LetterTypeController::class);
    Route::get('letter-types/template/{departmentId}', [LetterTypeController::class, 'create'])->name('letter-types.new');
    Route::get('letter-types/download/{id}',[LetterTypeController::class, 'download'])->name('letter-types.download');
    

    Route::post('letters/{letterCategory}/letter-types/{letterTypeId}', [ApplyLetterController::class, 'apply'])->name('letters.apply.store');
    Route::get('letters/{letterCategory}/letter-types/{letterTypeId}/edit', [ApplyLetterController::class, 'edit'])->name('letters.apply.edit');
    Route::put('letters/{letterCategory}/letter-types/{letterId}/edit', [ApplyLetterController::class, 'update'])->name('letters.apply.update');
    Route::post('letters/{letterCategory}/letter-types/', [ApplyLetterController::class, 'create'])->name('letters.apply');
    
    
    Route::prefix('letters')->name('letters.')->group(function(){

        Route::resource('cuti', SuratCutiController::class);
        Route::get('cuti/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('cuti.download');
        
        Route::resource('izin-meninggalkan-pekerjaan', SuratIzinMPController::class);
        Route::get('izin-meninggalkan-pekerjaan/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('izin-meninggalkan-pekerjaan.download');
        
        Route::resource('pertukaran-hari-kerja', SuratPertukaranHKController::class);
        Route::get('pertukaran-hari-kerja/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('pertukaran-hari-kerja.download');
       
        Route::resource('permohonan-saldo-cuti-pengganti', SuratPermohonSCPController::class);
        Route::get('permohonan-saldo-cuti-pengganti/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('permohonan-saldo-cuti-pengganti.download');
        
        Route::resource('penyimpangan-kehadiran', SuratPenyimpanganKehadiranController::class);
        Route::get('penyimpangan-kehadiran/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('penyimpangan-kehadiran.download');
        
        Route::resource('perintah-kerja-lembur', SuratPerintahLemburController::class);
        Route::get('perintah-kerja-lembur/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('perintah-kerja-lembur.download');
    });

    Route::get('letters/{letterCategory}/download/{letterID}', [LetterController::class, 'download'])->name('letters.download');

    Route::get('reports/{departmentID}/{letterTypeID}', [ReportController::class, 'filter'])->name('reports.filter');
    Route::post('reports/download/', [ReportController::class, 'download'])->name('reports.download');
    Route::get('letter-types/ckeditor/cktest', [LetterTypeController::class, 'test']);
    
});