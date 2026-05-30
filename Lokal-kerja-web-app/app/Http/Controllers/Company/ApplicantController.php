<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function index($job_id)
    {
        $job = JobPosting::where('company_id', Auth::id())->findOrFail($job_id);
        
        $applications = $job->applications()->with('user')->latest()->get();

        return view('company.applicants.index', compact('job', 'applications'));
    }

    public function show($id)
    {
        $application = Application::with('user.profile')->findOrFail($id);

        // Pastikan company yang melihat adalah pemilik lowongan
        if ($application->jobPosting->company_id !== Auth::id()) {
            abort(403);
        }

        $user = $application->user;
        $profile = $user->profile;

        return view('company.applicants.show', compact('application', 'user', 'profile'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        if ($application->jobPosting->company_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:Pending,Reviewed,Accepted,Rejected',
        ]);

        $application->update(['status' => $validated['status']]);

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
