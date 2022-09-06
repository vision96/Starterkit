<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//start bank routes
Route::get('/add-bank', function () {
    return view('add-bank');
})->name('add-bank');
Route::post('store-bank', [App\Http\Controllers\BankController::class, 'store'])->name('store-bank');
//Route::get('/show-banks', [App\Http\Controllers\BankController::class, 'index'])->name('show-bank');
//end bank routes

//start branch routes
Route::get('/add-branch', [App\Http\Controllers\BranchController::class, 'create'])->name('add-branch');
Route::post('store-branch', [App\Http\Controllers\BranchController::class, 'store'])->name('store-branch');
//Route::get('/show-branches', [App\Http\Controllers\BranchController::class, 'index'])->name('show-branches');
//end branch routes

