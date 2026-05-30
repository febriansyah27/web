<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jobs.profile', [
            'profile' => Auth::user()->profile,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        Profile::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'bio' => $data['bio'] ?? null,
                'phone' => $data['phone'] ?? null,
                'alamat' => $data['alamat'] ?? null,
                'job_title' => $data['job_title'] ?? null,
                'location' => $data['location'] ?? null,
            ]
        );

        return back()->with('success', 'Profile updated');
    }

    /**
     * Store new experience into JSON array.
     */
    public function storeExperience(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
        ]);

        $profile = Auth::user()->profile ?? Profile::create(['user_id' => Auth::id()]);
        $experiences = $profile->experience ?? [];
        $experiences[] = $data;
        $profile->update(['experience' => $experiences]);

        return back()->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    /**
     * Remove an experience from JSON array by index.
     */
    public function destroyExperience(int $index)
    {
        $profile = Auth::user()->profile;
        if ($profile) {
            $experiences = $profile->experience ?? [];
            if (isset($experiences[$index])) {
                array_splice($experiences, $index, 1);
                $profile->update(['experience' => $experiences]);
            }
        }
        return back()->with('success', 'Pengalaman kerja berhasil dihapus.');
    }

    /**
     * Store new education into JSON array.
     */
    public function storeEducation(Request $request)
    {
        $data = $request->validate([
            'school_name' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'start_year' => 'required|string|max:255',
            'end_year' => 'nullable|string|max:255',
        ]);

        $profile = Auth::user()->profile ?? Profile::create(['user_id' => Auth::id()]);
        $educations = $profile->education ?? [];
        $educations[] = $data;
        $profile->update(['education' => $educations]);

        return back()->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    /**
     * Remove an education from JSON array by index.
     */
    public function destroyEducation(int $index)
    {
        $profile = Auth::user()->profile;
        if ($profile) {
            $educations = $profile->education ?? [];
            if (isset($educations[$index])) {
                array_splice($educations, $index, 1);
                $profile->update(['education' => $educations]);
            }
        }
        return back()->with('success', 'Pendidikan berhasil dihapus.');
    }

    /**
     * Store new skill into JSON array.
     */
    public function storeSkill(Request $request)
    {
        $data = $request->validate([
            'skill_name' => 'required|string|max:255',
        ]);

        $profile = Auth::user()->profile ?? Profile::create(['user_id' => Auth::id()]);
        $skills = $profile->skills ?? [];
        if (!in_array($data['skill_name'], $skills)) {
            $skills[] = $data['skill_name'];
            $profile->update(['skills' => $skills]);
        }

        return back()->with('success', 'Keahlian berhasil ditambahkan.');
    }

    /**
     * Remove a skill from JSON array by index.
     */
    public function destroySkill(int $index)
    {
        $profile = Auth::user()->profile;
        if ($profile) {
            $skills = $profile->skills ?? [];
            if (isset($skills[$index])) {
                array_splice($skills, $index, 1);
                $profile->update(['skills' => $skills]);
            }
        }
        return back()->with('success', 'Keahlian berhasil dihapus.');
    }

    /**
     * Generate CV with AI Agent
     */
    public function generateCv(Request $request)
    {
        set_time_limit(120);
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return back()->with('error', 'Silakan simpan dan lengkapi data profil terlebih dahulu.');
        }

        $agent = new \App\Ai\Agents\GenerateCvAgent($user, $profile);

        try {
            // Memanggil agent dengan prompt awal. 
            $response = $agent->prompt('Tolong buatkan teks lengkap untuk CV saya berdasarkan data profil.');

            return view('jobs.cv-result', [
                'cvText' => $response->text
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses CV dengan AI: ' . $e->getMessage());
        }
    }

    /**
     * Download CV as PDF
     */
    public function downloadCvPdf(Request $request)
    {
        set_time_limit(120);
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return back()->with('error', 'Silakan simpan dan lengkapi data profil terlebih dahulu.');
        }

        $agent = new \App\Ai\Agents\GenerateCvAgent($user, $profile);

        try {
            $response = $agent->prompt('Tolong buatkan teks lengkap untuk CV saya berdasarkan data profil.');
            $cvText = $response->text;

            $pdf = \PDF::loadView('jobs.cv-pdf', ['cvText' => $cvText])
                ->setPaper('a4')
                ->setOption('margin-top', 0.5)
                ->setOption('margin-bottom', 0.5)
                ->setOption('margin-left', 0.5)
                ->setOption('margin-right', 0.5);

            return $pdf->download('CV-' . $user->name . '-' . now()->format('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunduh CV: ' . $e->getMessage());
        }
    }
}

