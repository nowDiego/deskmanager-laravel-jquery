<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneratorPDF;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalledController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CustomerController;

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
    return view('Auth.login');
});

Route::get('/login',[AuthController::class,'index'])->name('auth');

Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout')->middleware('auth');;

Route::get('/dashboard/support',[SupportController::class,'index'])->name('dashboard.support')->middleware(['auth','verifySupport']);

Route::get('/dashboard/customer',[CustomerController::class,'index'])->name('dashboard.customer')->middleware(['auth','verifyCustomer']);

Route::get('/support/user',[UserController::class,'index'])->name('support.user')->middleware(['auth','verifySupport']);

Route::get('/customer/called',[CalledController::class,'create'])->name('called.customer')->middleware(['auth','verifyCustomer']);

Route::get('/support/called',[CalledController::class,'index'])->name('called.support')->middleware(['auth','verifySupport']);

Route::get('/support/called/{called}/edit',[CalledController::class,'edit'])->name('called.edit')->middleware(['auth','verifySupport']);

Route::get('/customer/register',[CustomerController::class,'create'])->name('customer.create');

Route::get('/customer/profile',[CustomerController::class,'profile'])->name('customer.profile')->middleware(['auth','verifyCustomer']);

Route::get('/report/{data}',[GeneratorPDF::class,'generatorPdf'])->name('support.pdf')->middleware(['auth','verifySupport']);

