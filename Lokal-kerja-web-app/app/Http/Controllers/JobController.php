<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::with('company')->where('status', 'Aktif');

        // Simple search functionality if keyword is provided
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $jobs = $query->latest()->paginate(10);
        $totalJobs = $jobs->total();

        return view('jobs.index', compact('jobs', 'totalJobs'));
    }

    public function show($id)
    {
        $job = JobPosting::with('company')->findOrFail($id);
        
        $hasApplied = false;
        if (auth()->check()) {
            $hasApplied = $job->applications()->where('user_id', auth()->id())->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function createApplication($id)
    {
        $job = JobPosting::with('company')->findOrFail($id);

        if ($job->status !== 'Aktif') {
            return redirect()->route('jobs.show', $id)->with('error', 'Lowongan ini sudah tidak aktif.');
        }

        $hasApplied = $job->applications()->where('user_id', auth()->id())->exists();
        if ($hasApplied) {
            return redirect()->route('jobs.show', $id)->with('error', 'Anda sudah melamar posisi ini sebelumnya.');
        }

        $user = auth()->user()->load('profile');

        return view('jobs.apply', compact('job', 'user'));
    }

    public function storeApplication(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);

        if ($job->status !== 'Aktif') {
            return redirect()->route('jobs.show', $id)->with('error', 'Lowongan ini sudah tidak aktif.');
        }

        $hasApplied = $job->applications()->where('user_id', auth()->id())->exists();
        if ($hasApplied) {
            return redirect()->route('jobs.show', $id)->with('error', 'Anda sudah melamar posisi ini sebelumnya.');
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        $job->applications()->create([
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'cv_path' => $cvPath,
            'status' => 'Pending'
        ]);

        return redirect()->route('jobs.show', $id)->with('success', 'Lamaran Anda berhasil dikirim!');
    }
}

