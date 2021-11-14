<?php

use App\Http\Controllers\TransactionController;
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

Route::resource('/transaction', TransactionController::class)->except([
    'show',
])->names([
    'index' => 'transaction.index',
    'create' => 'transaction.create',
    'store' => 'transaction.store',
    'update' => 'transaction.update',
    'destroy' => 'transaction.destroy',
    'edit'  => 'transaction.edit'
]);

Route::get('/transaction/rekap', [TransactionController::class, 'rekap'])->name('transaction.rekap');

