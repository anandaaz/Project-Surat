<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\ApplyLetterController;
use App\Http\Controllers\SuratCutiController;

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
    
    Route::post('letters/{departmentID}/letter-types/{letterTypeId}', [ApplyLetterController::class, 'apply'])->name('letters.apply.store');
    Route::get('letters/{departmentID}/letter-types/{letterTypeId}/edit', [ApplyLetterController::class, 'edit'])->name('letters.apply.edit');
    Route::put('letters/{departmentID}/letter-types/{letterId}/edit', [ApplyLetterController::class, 'update'])->name('letters.apply.update');
    Route::post('letters/{departmentID}/letter-types/', [ApplyLetterController::class, 'create'])->name('letters.apply');
    
    Route::resource('letters', LetterController::class);
    Route::get('letters/{departmentID}/download/{letterID}', [LetterController::class, 'download'])->name('letters.download');
    
    Route::resource('reports', ReportController::class);
    Route::get('letter-types/ckeditor/cktest', [LetterTypeController::class, 'test']);
    Route::resource('surat-cuti', SuratCutiController::class);
    Route::get('surat-cuti/{departmentID}/download/{surat-cuti-id}', [SuratCutiController::class, 'download'])->name('surat-cuti.download');
    
});