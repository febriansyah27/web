<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [authController::class, 'register'])->name('auth.register');
Route::get('/login', [authController::class, 'login'])->name('auth.login');
Route::post('/register', [authController::class, 'store'])->name('auth.store');
Route::post('login', [authController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout',[authController::class, 'logout'])->name('auth.logout');


Route::middleware(['auth', 'role:job_seeker'])
    ->group(function () {
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{job}/apply', [JobController::class, 'createApplication'])->name('jobs.apply.create');
        Route::post('/jobs/{job}/apply', [JobController::class, 'storeApplication'])->name('jobs.apply.store');

        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('jobs.profile');
        Route::post('/profile', [ProfileController::class, 'store'])
            ->name('profile.store');

        // JSON Profile Endpoints
        Route::post('/profile/experience', [ProfileController::class, 'storeExperience'])->name('profile.experience.store');
        Route::delete('/profile/experience/{index}', [ProfileController::class, 'destroyExperience'])->name('profile.experience.destroy');

        Route::post('/profile/education', [ProfileController::class, 'storeEducation'])->name('profile.education.store');
        Route::delete('/profile/education/{index}', [ProfileController::class, 'destroyEducation'])->name('profile.education.destroy');

        Route::post('/profile/skill', [ProfileController::class, 'storeSkill'])->name('profile.skill.store');
        Route::delete('/profile/skill/{index}', [ProfileController::class, 'destroySkill'])->name('profile.skill.destroy');

        Route::post('/profile/generate-cv', [ProfileController::class, 'generateCv'])->name('profile.generate_cv');
        Route::get('/profile/download-cv-pdf', [ProfileController::class, 'downloadCvPdf'])->name('profile.download_cv_pdf');

    });
