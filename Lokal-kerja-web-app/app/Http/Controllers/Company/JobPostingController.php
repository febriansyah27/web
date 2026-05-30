<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{
    public function index()
    {
        return redirect()->route('company.dashboard');
    }

    public function create()
    {
        return view('company.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Draft,Tutup',
            'deadline' => 'nullable|date|after:today',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'category' => 'nullable|string|max:100',
        ]);

        $validated['company_id'] = Auth::id();

        JobPosting::create($validated);

        return redirect()->route('company.dashboard')->with('success', 'Lowongan kerja berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $job = JobPosting::where('company_id', Auth::id())->findOrFail($id);
        return view('company.jobs.show', compact('job'));
    }

    public function edit(string $id)
    {
        $job = JobPosting::where('company_id', Auth::id())->findOrFail($id);
        return view('company.jobs.edit', compact('job'));
    }

    public function update(Request $request, string $id)
    {
        $job = JobPosting::where('company_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Draft,Tutup',
            'deadline' => 'nullable|date|after:today',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'category' => 'nullable|string|max:100',
        ]);

        $job->update($validated);

        return redirect()->route('company.dashboard')->with('success', 'Lowongan kerja berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $job = JobPosting::where('company_id', Auth::id())->findOrFail($id);
        $job->delete();

        return redirect()->route('company.dashboard')->with('success', 'Lowongan kerja berhasil dihapus.');
    }
}
