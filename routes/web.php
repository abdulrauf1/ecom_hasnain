<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PayrollsController;
use App\Http\Controllers\ControllsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/calculator', function(){
        return view('calculator.calculator');
    })->name('calculator.calculator');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees.view');
    Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeesController::class, 'store'])->name('employees.store');
    Route::post('/employees/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
    Route::post('/employee/{id}', [EmployeesController::class, 'destroy'])->name('employee.destroy');
   
});


Route::middleware('auth')->group(function () {
    Route::get('/payrolls', [PayrollsController::class, 'index'])->name('payrolls.view');
    Route::get('/payrolls/create', [PayrollsController::class, 'create'])->name('payrolls.create');
    Route::post('/payrolls', [PayrollsController::class, 'store'])->name('payrolls.store');
    Route::get('/payrolls/{id}', [PayrollsController::class, 'show'])->name('payrolls.show');
    Route::get('/payroll/{id}', [PayrollsController::class, 'download'])->name('payroll.download');
    Route::post('/payroll', [PayrollsController::class, 'calculator'])->name('payroll.calculator');
    // Route::post('/employees/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
    // Route::post('/employee/{id}', [EmployeesController::class, 'destroy'])->name('employee.destroy');
   
});



Route::middleware('auth')->group(function () {
    Route::get('/controls', [ControllsController::class, 'index'])->name('controls.view');
    Route::post('/controls/{id}', [ControllsController::class, 'edit'])->name('controls.edit');
    // Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
    // Route::post('/employees', [EmployeesController::class, 'store'])->name('employees.store');
    // Route::post('/employees/{id}', [EmployeesController::class, 'edit'])->name('employees.edit');
    // Route::post('/employee/{id}', [EmployeesController::class, 'destroy'])->name('employee.destroy');
   
});

require __DIR__.'/auth.php';
