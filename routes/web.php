<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WirthdrawController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    $acc = User::find(Auth::id());
    return view('dashboard', compact('acc'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//
    Route::patch('/dashboard', [DepositController::class, 'applyCC'])->name('apply.credit');

    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
    Route::patch('/deposit', [DepositController::class, 'addCash'])->name('deposit.add');


    Route::get('/transfer', [TransferController::class, 'index'])->name('transfer');
    Route::patch('/transfer', [TransferController::class, 'TransferMoney'])->name('transfer.money');

    Route::get('/wirthdraw', [WirthdrawController::class, 'index'])->name('wirthdraw');
    Route::put('/wirthdraw', [WirthdrawController::class, 'wirthdraw'])->name('wirthdraw.cash');
});

require __DIR__.'/auth.php';
