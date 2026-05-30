<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class GenerateCvAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    protected $user;
    protected $profile;

    public function __construct($user, $profile)
    {
        $this->user = $user;
        $this->profile = $profile;
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        $skills = implode(', ', $this->profile->skills ?? []);
        
        $academicArray = array_map(function($edu) {
            $school = $edu['school_name'] ?? '';
            $degree = $edu['degree'] ?? '';
            $major = $edu['major'] ?? '';
            $start = $edu['start_year'] ?? '';
            $end = $edu['end_year'] ?? 'Sekarang';
            return "- {$school} | {$degree} {$major} ({$start} - {$end})";
        }, $this->profile->education ?? []);
        $academic = implode("\n        ", $academicArray);

        $experienceArray = array_map(function($exp) {
            $company = $exp['company_name'] ?? '';
            $job = $exp['job_title'] ?? '';
            $start = $exp['start_date'] ?? '';
            $end = $exp['end_date'] ?? 'Sekarang';
            return "- {$job} di {$company} ({$start} - {$end})";
        }, $this->profile->experience ?? []);
        $experience = implode("\n        ", $experienceArray);

        return "
Anda adalah sistem pembuat Curriculum Vitae (CV) profesional ATS-friendly.
Tugas Anda adalah menghasilkan struktur CV murni dalam format Markdown berdasarkan data yang diberikan.

ATURAN SANGAT PENTING:
1. JANGAN gunakan kalimat pembuka seperti 'Tentu, berikut adalah CV Anda' atau 'Berikut CV berdasarkan profil yang diberikan'.
2. JANGAN gunakan kalimat penutup seperti 'Semoga sukses', 'Beri tahu saya jika ada perubahan', dsb.
3. HANYA KELUARKAN teks CV-nya saja dari awal (Nama) sampai akhir (Pengalaman/Pendidikan/Skill).
4. Buatlah sekadar layout Markdown yang profesional dan ATS-friendly.

DATA PROFIL:
Nama: {$this->user->name}
Email: {$this->user->email}
Telepon: {$this->profile->phone}
Alamat: {$this->profile->alamat}

Bio:
{$this->profile->bio}

Keahlian:
{$skills}

Pengalaman Kerja:
{$experience}

Pendidikan:
{$academic}
";
    }

    /**
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
