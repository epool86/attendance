<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');;
    Route::get('/clock', [ClockController::class, 'get'])->name('clock.get');
    Route::get('/clock/in', [ClockController::class, 'getIn'])->name('clock.getIn');
    Route::get('/clock/out', [ClockController::class, 'getOut'])->name('clock.getOut');

    Route::middleware(['admin'])->group(function () {
        Route::resource('/department', DepartmentController::class);
        Route::resource('/user', UserController::class);
        Route::get('/report', [ReportController::class, 'report'])->name('report');
        Route::get('/report/pdf', [ReportController::class, 'reportPDF'])->name('report.pdf');
        Route::get('/report/excel', [ReportController::class, 'reportExcel'])->name('report.excel');
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
