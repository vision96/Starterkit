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
Route::get('/show-banks', [App\Http\Controllers\BankController::class, 'index'])->name('show-banks');
//end bank routes

//start branch routes
//Route::get('/add-branch', [App\Http\Controllers\BranchController::class, 'create'])->name('add-branch');
Route::post('store-branch', [App\Http\Controllers\BranchController::class, 'store'])->name('store-branch');
Route::get('/show-branches', [App\Http\Controllers\BranchController::class, 'index'])->name('show-branches');
//end branch routes

//start cheque routes
Route::get('/add-cheque', [App\Http\Controllers\ChequeController::class, 'create'])->name('add-cheque');
Route::post('store-cheque', [App\Http\Controllers\ChequeController::class, 'store'])->name('store-cheque');
Route::get('/show-cheques', [App\Http\Controllers\ChequeController::class, 'index'])->name('show-cheques');
Route::get('/cheque-number/{id}', [App\Http\Controllers\ChequeController::class, 'getChequeNumber'])->name('cheque_number.view');

Route::get('cheques/{id}/edit', [App\Http\Controllers\ChequeController::class, 'edit'])->name('cheque.edit');
Route::post('cheques/{id}', [App\Http\Controllers\ChequeController::class, 'update'])->name('cheque.update');

//end cheque routes

//start chequeRecipients routes
Route::get('cheque_recipient/{id}/edit', [App\Http\Controllers\ChequeRecipientController::class, 'edit'])->name('recipient.edit');
Route::post('cheque_recipient/{id}', [App\Http\Controllers\ChequeRecipientController::class, 'update'])->name('recipient.update');

Route::post('store-chequeRecipients', [App\Http\Controllers\ChequeRecipientController::class, 'store'])->name('store-chequeRecipients');
Route::get('/show-chequeRecipients', [App\Http\Controllers\ChequeRecipientController::class, 'index'])->name('show-chequeRecipients');
//end chequeRecipients routes

//start settings
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
//end settings
