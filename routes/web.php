<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
};

use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\InRegisterController;
use App\Http\Controllers\ManufactureRegisController;
use App\Http\Controllers\NewRegisController;
use App\Http\Controllers\RenewRegisController;
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
    return redirect('/admin/login'); // เปลี่ยนเส้นทางไปยัง /admin/login
});

Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');


// require __DIR__ . '/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';




Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
        Route::get('/production', [ProductionController::class, 'index'])->name('production.index');
        // Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    });

Route::get('/import', [ImportController::class, 'index'])->name('import.index');
Route::get('/import/create', [ImportController::class, 'create'])->name('import.create');
Route::post('/import/store', [ImportController::class, 'store'])->name('import.store');
Route::get('/import/{import}/edit', [ImportController::class, 'edit'])->name('import.edit');
Route::put('/import/{import}', [ImportController::class, 'update'])->name('import.update');
Route::delete('/import/{import}', [ImportController::class, 'destroy'])->name('import.destroy');
Route::get('/import/{import}', [ImportController::class, 'show'])->name('import.show');

Route::get('/new/product', [NewRegisController::class, 'index'])->name('newregis.index');
Route::get('/renew/product', [RenewRegisController::class, 'index'])->name('renewregis.index');
Route::get('/manufactture/product', [ManufactureRegisController::class, 'index'])->name('manufactureregis.index');

