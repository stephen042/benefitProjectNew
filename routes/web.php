<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\SendController;
use App\Http\Controllers\User\SwapController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\TradeController;
use App\Http\Controllers\User\ReceiveController;
use App\Http\Controllers\Admin\AllUsersController;
use App\Http\Controllers\Admin\AdminWalletAddresses;

Route::redirect('/', '/login')->name('home');

// Route::get('/learn', function () {
//     return view('home.learn');
// })->name('home.learn');

Route::redirect('/download', '/login');
Route::redirect('/en', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('dashboard');
        Route::get('/receive', [ReceiveController::class, 'receive'])->name('user.receive');
        Route::get('/send', [SendController::class, 'send'])->name('user.send');
        Route::get('/swap', [SwapController::class, 'showSwap'])->name('user.swap');
        Route::get('/trade', [TradeController::class, 'trade'])->name('user.trade');

        // history routes
        Route::get('/trade-history', [TradeController::class, 'tradeHistory'])->name('user.trade.history');
        Route::get('/receive-history', [ReceiveController::class, 'receiveHistory'])->name('user.receive.history');
        Route::get('/send-history', [SendController::class, 'sendHistory'])->name('user.send.history');
    });

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'is_admin', 'verified'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', [AllUsersController::class, 'index'])->name('admin.dashboard');
        Route::get('/edit-users/{id}', [AllUsersController::class, 'editUsers'])->name('admin.user.edit');
        Route::get('/wallet-address', [AdminWalletAddresses::class, 'index'])->name('admin.wallet.address');

        // Admin Settings Routes
        Volt::route('settings/profile', 'settings.profile')->name('admin.settings.profile');
        Volt::route('settings/password', 'settings.password')->name('admin.settings.password');
        Volt::route('settings/appearance', 'settings.appearance')->name('admin.settings.appearance');
    });
});



require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect('/');
});
