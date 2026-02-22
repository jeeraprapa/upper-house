<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AlbumShareController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\QuestionnaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicShareController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/datenow', function () {
    echo now();
});


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'done';
});


Route::prefix('admin')->group(function () {
    Route::middleware(['auth','verified'])->group(function () {
        Route::get('/', function () {
            //redirect to admin dashboard
            return redirect()->route('dashboard');
        });

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/questionnaires', [QuestionnaireController::class, 'index'])->name('admin::questionnaire');
        Route::get('/questionnaires/export', [QuestionnaireController::class, 'exportExcel'])->name('admin::questionnaire.export');

        Route::name('admin::')->group(function () {
            Route::resource('albums', AlbumController::class)
                 ->except(['show']);

            Route::post('albums/{album}/photos', [PhotoController::class, 'store'])->name('albums.photos.store');
            Route::patch('photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
            Route::delete('photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

            Route::post('albums/{album}/photos/sort', [PhotoController::class, 'sort'])->name('albums.photos.sort'); // optional

            Route::post('/albums/{album}/shares', [AlbumShareController::class, 'store'])->name('albums.shares.store');
            Route::patch('/shares/{share}/revoke', [AlbumShareController::class, 'revoke'])->name('shares.revoke');
            Route::patch('/shares/{share}/restore', [AlbumShareController::class, 'restore'])->name('shares.restore');
            Route::delete('/shares/{share}', [AlbumShareController::class, 'destroy'])->name('shares.destroy');
        });


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});


Route::get('/questionnaire', [App\Http\Controllers\QuestionnaireController::class, 'create'])->name('questionnaire.create');

//create questionnaire routes
Route::POST('/questionnaire/store', [App\Http\Controllers\QuestionnaireController::class, 'store'])->name('questionnaire.store');


Route::get('/{slug}/{token}', [PublicShareController::class, 'show'])->name('share.show');

