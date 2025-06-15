<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


<<<<<<< Updated upstream

Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
Route::put('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');
Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
=======
    // Grades
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
});
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/grades/average', [GradeController::class, 'averageGrades'])->name('grades.average');
    Route::get('/grades/export/average/excel', [GradeController::class, 'exportAverageExcel'])->name('grades.export.average.excel');
    Route::get('/grades/export/average/pdf', [GradeController::class, 'exportAveragePdf'])->name('grades.export.average.pdf');
});
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes

Route::get('/grades/export/excel', [GradeController::class, 'exportExcel'])->name('grades.export.excel');
Route::get('/grades/export/pdf', [GradeController::class, 'exportPdf'])->name('grades.export.pdf');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});
require __DIR__.'/auth.php';
