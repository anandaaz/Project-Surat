<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LetterTypeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class); // auto generate route get, show, post, patch/put, delete route
    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::delete('departments/remove/{userID}', [DepartmentController::class, 'removeUser'])->name('departments.remove.user');
    
    Route::resource('letter-types', LetterTypeController::class);
    Route::get('letter-types/download/{id}',[ LetterTypeController::class, 'download'])->name('letter-types.download');
    Route::resource('letters', LetterController::class);
    Route::resource('reports', ReportController::class);
});