<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GeneratorGraph;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalledController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/customer',[CustomerController::class,'store'])->name('customer.store')->middleware(['auth','verifySupport']);

// Route::delete('/customer',[CustomerController::class,'destroy'])->name('customer.destroy')->middleware(['auth','verifyCustomer']);;

Route::post('/customer/password/reset',[UserController::class,'passwordResetCustomer'])->name('customer.password')->middleware(['auth','verifyCustomer']);

Route::post('/customer/address',[CustomerController::class,'address'])->name('customer.address')->middleware(['auth','verifyCustomer']);

Route::get('/customer/address/{address}/destroy',[CustomerController::class,'destroyAddress'])->name('address.destroy')->middleware(['auth','verifyCustomer']);

Route::post('/support',[SupportController::class,'store'])->name('support.store')->middleware(['auth','verifySupport']);

// Route::delete('/support',[SupportController::class,'destroy'])->name('support.destroy')->middleware(['auth','verifySupport']);

Route::post('/called',[CalledController::class,'store'])->name('called.store')->middleware(['auth','verifyCustomer']);

Route::put('/called',[CalledController::class,'disableCalled'])->name('called.disableCalled')->middleware(['auth','verifySupport']);

Route::delete('/called',[CalledController::class,'destroy'])->name('called.destroy')->middleware(['auth','verifySupport']);

Route::post('/auth',[AuthController::class,'login'])->name('auth.login');

Route::get('/graph',[GeneratorGraph::class,'generatorGraph'])->name('generator.graph')->middleware(['auth','verifySupport']);



