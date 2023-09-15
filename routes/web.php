<?php
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\TypeDeviceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdenesController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('home');
Route::get('users', [UserController::class, 'index'])->middleware(['auth','admin'])->name('users.index');
Route::get('marcas', BrandController::class)->middleware('auth')->name('devices.brands');
Route::get('tipo-dispositivo', TypeDeviceController::class)->middleware('auth')->name('devices.type-devices');
Route::get('dispositivos', DeviceController::class)->middleware('auth')->name('devices.index');
Route::get('modelos', ModelController::class)->middleware('auth')->name('devices.models');
Route::get('areas', [AreaController::class, 'index'])->middleware('auth')->name('customers.areas');
Route::get('customers', [CustomerController::class, 'index'])->middleware('auth')->name('customers.index');
Route::get('ordenes', [OrdenesController::class, 'index'])->middleware('auth')->name('ordenes.index');
Route::get('ordenes/create',[OrdenesController::class,'create'])->middleware('auth')->name('ordenes.create');
