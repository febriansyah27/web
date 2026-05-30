<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalJobs = \App\Models\JobPosting::count();
    $totalCompanies = \App\Models\User::where('role', 'company')->count();
    $totalSeekers = \App\Models\User::where('role', 'job_seeker')->count();
$featuredJobs = \App\Models\JobPosting::with('company')->latest()->take(3)->get();
    return view('welcome', compact('totalJobs', 'totalCompanies', 'totalSeekers', 'featuredJobs'));
});

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

Route::middleware(['auth', 'role:company'])
    ->group(function () {
        Route::get('/company/dashboard', [\App\Http\Controllers\Company\DashboardController::class, 'index'])->name('company.dashboard');
        
        // Resource routes untuk lowongan kerja
        Route::resource('/company/jobs', \App\Http\Controllers\Company\JobPostingController::class, [
            'as' => 'company'
        ]);

        // Routes untuk manajemen pelamar
        Route::get('/company/jobs/{job}/applicants', [\App\Http\Controllers\Company\ApplicantController::class, 'index'])->name('company.applicants.index');
        Route::get('/company/applicants/{application}', [\App\Http\Controllers\Company\ApplicantController::class, 'show'])->name('company.applicants.show');
        Route::patch('/company/applicants/{application}/status', [\App\Http\Controllers\Company\ApplicantController::class, 'updateStatus'])->name('company.applicants.updateStatus');
        
        // CV Download
        Route::get('/company/cv/{application}/download', [\App\Http\Controllers\Company\CvDownloadController::class, 'download'])->name('company.cv.download');
    });
