<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserExportController;

Route::get('/', [ContactController::class, 'index']);
Route::get('/contact', function () {
    return view('contact');
})->name('contact.form');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
});
Route::get('/admin', [AuthController::class, 'search']);
Route::delete('/contacts/delete', [AuthController::class, 'destroy']);
Route::get('admin/users/export', [UserExportController::class, 'export'])->name('admin.users.export');
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
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
    return view('index');
});
