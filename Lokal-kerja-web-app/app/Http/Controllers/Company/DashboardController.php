<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Statistik
        $activeJobs = $user->jobPostings()->where('status', 'Aktif')->count();
        
        $jobPostings = $user->jobPostings()->withCount('applications')->get();
        $totalApplicants = $jobPostings->sum('applications_count');
        
        // Menghitung tingkat seleksi (Accepted / Total)
        $accepted = $user->jobPostings()->withCount(['applications' => function($q) {
            $q->where('status', 'Accepted');
        }])->get()->sum('applications_count');

        $selectionRate = $totalApplicants > 0 ? round(($accepted / $totalApplicants) * 100) : 0;

        // Daftar lowongan paginasi
        $jobs = $user->jobPostings()
                     ->withCount('applications')
                     ->latest()
                     ->paginate(5);

        return view('company.dashboard', compact(
            'activeJobs', 
            'totalApplicants', 
            'selectionRate', 
            'jobs'
        ));
    }
}
