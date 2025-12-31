<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backoffice\BackofficeController;
use App\Http\Controllers\Backoffice\NoReasons\NoReasonController;

use App\Http\Controllers\BackofficeAuth\BackofficeLoginController;
use App\Http\Controllers\BackofficeAuth\BackofficeLogoutController;
use App\Http\Controllers\BackofficeAuth\BackofficeRestPasswordController;

use App\Http\Controllers\BackofficeUser\BackofficeProfileController;
use App\Http\Controllers\BackofficeUser\BackofficeChangePasswordController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\SpecificNoController;

use App\Http\Middleware\RedirectIfAuthenticatedCustom;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/no/{id}', [SpecificNoController::class, 'show'])->name('no.specific');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backoffice Group Middleware 
Route::middleware(['auth', 'role:admin'])
    ->prefix('/backoffice')
    ->group(function () {
        Route::get('/dashboard', [BackofficeController::class, 'backofficeDashboard'])->name('backoffice.dashboard');
        Route::get('/logout', [BackofficeLogoutController::class, 'backofficeLogout'])->name('backoffice.logout');
        // Backoffice User manage profile data
        Route::get('/profile', [BackofficeProfileController::class, 'backofficeProfile'])->name('backoffice.profile');
        Route::post('/profile/store', [BackofficeProfileController::class, 'backofficeProfileStore'])->name('backoffice.profile.store');
        // Backoffice User update password
        Route::get('/change/password', [BackofficeChangePasswordController::class, 'backofficeChangePassword'])->name('backoffice.change.password');
        Route::post('/password/update', [BackofficeChangePasswordController::class, 'backofficePasswordUpdate'])->name('backoffice.password.update');


        Route::prefix('/no-reasons')->name('backoffice.no-reasons.')->group(function () {
            Route::get('/', [NoReasonController::class, 'index'])->name('index');
            Route::get('/create', [NoReasonController::class, 'create'])->name('create');
            Route::post('/store', [NoReasonController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [NoReasonController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [NoReasonController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [NoReasonController::class, 'destroy'])->name('destroy');
            
            Route::get('/export', [NoReasonController::class, 'export'])->name('export');
            Route::get('/import', [NoReasonController::class, 'importNoReasons'])->name('import.no.reasons');
            Route::post('/import', [NoReasonController::class, 'importNoReasonsStore'])->name('import.store');
        });
    }); // End Group Backoffice Middleware

// Route Accessable for All 
Route::get('/backoffice/login', [BackofficeLoginController::class, 'backofficeLogin'])->name('backoffice.login')->middleware(RedirectIfAuthenticatedCustom::class);
Route::post('/backoffice/login', [BackofficeLoginController::class, 'store'])->name('backoffice.login.store')->middleware(RedirectIfAuthenticatedCustom::class);
Route::get('/backoffice/forget', [BackofficeRestPasswordController::class, 'backofficeForgetPassword'])->name('backoffice.password.request')->middleware(RedirectIfAuthenticatedCustom::class);
Route::get('/backoffice/reset-password/{token}', [BackofficeRestPasswordController::class, 'backofficeResetPassword'])->name('backoffice.password.reset')->middleware(RedirectIfAuthenticatedCustom::class);

// Mayby needed later
//require __DIR__.'/auth.php';
