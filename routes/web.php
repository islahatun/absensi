<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AttandenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HeaderBarangController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');
Route::get('/login',[AuthController::class,'index'])->name('login')->middleware('guest');
Route::post('/login-submit',[AuthController::class,'login'])->name('login-submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');


// Dashboard
// Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard');

Route::get('/getDataDepartement', [DepartementController::class, 'getData'])->name('getDataDepartement')->middleware('auth');
Route::post('/updateDepartement', [DepartementController::class, 'update'])->name('departement.update')->middleware('auth');
Route::resource('departement',DepartementController::class)->names([
    'index'   => 'departement.index',
    'create'  => 'departement.create',
    'store'   => 'departement.store',
    'show'    => 'departement.show',
    'edit'    => 'departement.edit',
    'destroy' => 'departement.destroy',
])->except('update')->middleware('auth');


Route::get('/getDataUser', [UserController::class, 'getData'])->name('getDataUser')->middleware('auth');
Route::post('/updateUser', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::resource('user',UserController::class)->names([
    'index'   => 'user.index',
    'create'  => 'user.create',
    'store'   => 'user.store',
    'show'    => 'user.show',
    'edit'    => 'user.edit',
    'destroy' => 'user.destroy',
])->except('update')->middleware('auth');

Route::get('/getDataCompany', [CompanyController::class, 'getData'])->name('getDataCompany')->middleware('auth');
Route::post('/updateCompany', [CompanyController::class, 'update'])->name('company.update')->middleware('auth');
Route::resource('company',CompanyController::class)->names([
    'index'   => 'company.index',
    'create'  => 'company.create',
    'store'   => 'company.store',
    'show'    => 'company.show',
    'edit'    => 'company.edit',
    'destroy' => 'company.destroy',
])->except('update')->middleware('auth');

Route::get('/getDataAttandence', [AttandenceController::class, 'getData'])->name('getDataAttandence')->middleware('auth');
Route::post('/updateAttandence', [AttandenceController::class, 'update'])->name('attandence.update')->middleware('auth');
Route::resource('attandence',AttandenceController::class)->names([
    'index'   => 'attandence.index',
    'create'  => 'attandence.create',
    'store'   => 'attandence.store',
    'show'    => 'attandence.show',
    'edit'    => 'attandence.edit',
    'destroy' => 'attandence.destroy',
])->except('update')->middleware('auth');

Route::get('/getDataIzin', [IzinController::class, 'getData'])->name('getDataIzin')->middleware('auth');
Route::post('/updateIzin', [IzinController::class, 'update'])->name('izin.update')->middleware('auth');
Route::resource('izin',IzinController::class)->names([
    'index'   => 'izin.index',
    'create'  => 'izin.create',
    'store'   => 'izin.store',
    'show'    => 'izin.show',
    'edit'    => 'izin.edit',
    'destroy' => 'izin.destroy',
])->except('update')->middleware('auth');




// Route::redirect('/', '/dashboard-general-dashboard');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

