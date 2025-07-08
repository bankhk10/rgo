<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
};


use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ManufactureRegisController;
use App\Http\Controllers\ChemicalRegistrationController;
use App\Http\Controllers\RenewRegisController;
use App\Http\Controllers\ChemicalImportController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/dashboard', function () {
//     return view('front.dashboard');
// })->middleware(['front'])->name('dashboard');


// require __DIR__ . '/front_auth.php';

// Admin routes
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('admin.dashboard');

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
    });

Route::get('/import', [ChemicalImportController::class, 'index'])->name('import.index');
Route::get('/import/create', [ChemicalImportController::class, 'create'])->name('import.create');
Route::post('/import/store', [ChemicalImportController::class, 'store'])->name('import.store');
Route::get('/import/{import}/edit', [ChemicalImportController::class, 'edit'])->name('import.edit');
Route::put('/import/{import}', [ChemicalImportController::class, 'update'])->name('import.update');
Route::delete('/import/{import}', [ChemicalImportController::class, 'destroy'])->name('import.destroy');
Route::get('/import/{import}', [ChemicalImportController::class, 'show'])->name('import.show');

Route::get('/new/product', [ChemicalRegistrationController::class, 'index'])->name('newregis.index');
Route::get('/new/product/show/{registrationNumber}', [ChemicalRegistrationController::class, 'show'])->name('newregis.show');
Route::get('/new/product/create', [ChemicalRegistrationController::class, 'create'])->name('newregis.create');
Route::post('/new/product/store', [ChemicalRegistrationController::class, 'store'])->name('newregis.store');
Route::get('/new/product/edit/{registrationNumber}', [ChemicalRegistrationController::class, 'edit'])->name('newregis.edit');
Route::put('/new/product/update/{registrationNumber}', [ChemicalRegistrationController::class, 'update'])->name('newregis.update');
Route::delete('/newregis/{id}', [ChemicalRegistrationController::class, 'destroy'])->name('newregis.destroy');

Route::put('/newregis/{drug}/update-subprogress', [ChemicalRegistrationController::class, 'updateSubProgress'])->name('newregis.update-subprogress');



Route::get('/renew/product', [RenewRegisController::class, 'index'])->name('renewregis.index');
Route::get('/manufactture/product', [ManufactureRegisController::class, 'index'])->name('manufactureregis.index');

Route::resource('company', CompanyController::class);
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


Route::get('/chemical-imports/import', [ChemicalImportController::class, 'showImportForm'])->name('chemical_imports.import.form');
Route::post('/chemical-imports/import', [ChemicalImportController::class, 'import'])->name('chemical_imports.import');
