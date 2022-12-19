<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KosanController;
use App\Http\Controllers\LoginController;
use App\Models\Kosan;
use App\Http\Controllers\KosramboController;
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
    $jumlahkosan = Kosan::count();
    $jumlahkosancowo = Kosan::where('jeniskelamin','cowo')->count();
    $jumlahkosancewe = Kosan::where('jeniskelamin','cewe')->count();
    return view('welcome',compact('jumlahkosan','jumlahkosancowo','jumlahkosancewe'));
})->middleware('auth');

Route::get('/kosan',[KosanController::class, 'index'])->name('kosan')->middleware('auth');
Route::get('/tambahkosan',[KosanController::class, 'tambahkosan'])->name('tambahkosan');
Route::post('/insertdata',[KosanController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}',[KosanController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}',[KosanController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[KosanController::class, 'delete'])->name('delete');

//export pdf
Route::get('/exportpdf',[KosanController::class, 'exportpdf'])->name('exportpdf');

//export excel
Route::get('/exportexcel',[KosanController::class, 'exportexcel'])->name('exportexcel');


Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginproses',[LoginController::class, 'loginproses'])->name('loginproses');


Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');





