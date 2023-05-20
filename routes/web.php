<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\UbicacionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();



Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('home');
    Route::get('/dashboard/data', [DashboardController::class,'data'])->name('dashboard.data');
    

    // ADMINISTRADOR
    Route::resource('users',UserController::class)->only('index','edit','update');
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);

    //TRANSCRIPTOR 
    Route::resource('movimientos',MovimientoController::class);
    Route::resource('categorias',CategoriaController::class);
    Route::resource('bienes',BienController::class);
    Route::resource('ubicaciones',UbicacionController::class, ['parameters' => ['ubicacione' => 'ubicacion']]);

});
