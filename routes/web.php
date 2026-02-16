<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/questionnaire', [App\Http\Controllers\QuestionnaireController::class, 'create'])->name('questionnaire.create');

//create questionnaire routes
Route::POST('/questionnaire/store', [App\Http\Controllers\QuestionnaireController::class, 'store'])->name('questionnaire.store');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        //redirect to admin dashboard
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin::dashboard');

    Route::get('/questionnaires', [App\Http\Controllers\Admin\QuestionnaireController::class, 'index'])->name('admin::questionnaire');
    Route::get('/questionnaires/export', [App\Http\Controllers\Admin\QuestionnaireController::class, 'exportExcel'])->name('admin::questionnaire.export');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

