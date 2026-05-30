<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CvDownloadController extends Controller
{
    public function download($applicationId)
    {
        $application = Application::findOrFail($applicationId);
        
        $job = $application->jobPosting;
        if ($job->company_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!$application->cv_path) {
            return redirect()->back()->with('error', 'File CV tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($application->cv_path)) {
            return redirect()->back()->with('error', 'File CV tidak ditemukan.');
        }

        return Storage::disk('public')->download($application->cv_path);
    }
}
