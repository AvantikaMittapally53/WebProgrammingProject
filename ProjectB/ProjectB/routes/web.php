<?php

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
  
Route::get('/', function () {
    try{
        if(auth()->user()->role == 'user'){
            return view('dashboard');
    
        }else if(auth()->user()->role == 'admin'){
            return redirect('admin');
    
    
        }else{
            return view('welcome');
    
        }
    }catch(\Exception $e){
        return view('welcome');

    }
   
});
  
Auth::routes();
  
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('2fa');
Route::get('/user/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('profile')->middleware('2fa');
Route::get('/user/show_reset', [App\Http\Controllers\DashboardController::class, 'show_reset'])->name('show_reset')->middleware('2fa');


Route::post('/user/update', [App\Http\Controllers\DashboardController::class, 'update'])->name('update')->middleware('2fa');
Route::post('/user/reset_password', [App\Http\Controllers\DashboardController::class, 'reset_password'])->name('reset_password')->middleware('2fa');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('2fa');
Route::post('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('update')->middleware('2fa');

Route::get('2fa', [App\Http\Controllers\TwoFactorAuthController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFactorAuthController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFactorAuthController::class, 'resend'])->name('2fa.resend');