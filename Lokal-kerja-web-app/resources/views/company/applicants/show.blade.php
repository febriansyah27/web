<x-company-layout title="Detail Pelamar">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div>
                <a href="{{ route('company.applicants.index', $application->job_posting_id) }}" class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-emerald-800 transition">
                    <x-lucide-arrow-left class="h-4 w-4" /> Kembali ke Daftar Pelamar
                </a>
                <h1 class="text-2xl font-bold text-slate-900">Detail Pelamar</h1>
                <p class="mt-1 text-sm text-slate-500">Melamar untuk posisi <span class="font-semibold text-slate-700">{{ $application->jobPosting->title }}</span></p>
            </div>
            
            <form action="{{ route('company.applicants.updateStatus', $application->id) }}" method="POST" class="flex items-center gap-3">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" onchange="this.form.submit()">
                    <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Reviewed" {{ $application->status == 'Reviewed' ? 'selected' : '' }}>Direview</option>
                    <option value="Accepted" {{ $application->status == 'Accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3 text-emerald-800">
                <x-lucide-check-circle class="h-5 w-5 text-emerald-500" />
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid gap-8 md:grid-cols-3">
            <!-- Sidebar: Profil Dasar -->
            <div class="md:col-span-1 space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col items-center text-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-3xl font-bold text-emerald-700">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h2 class="mt-4 text-lg font-bold text-slate-900">{{ $user->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $profile ? $profile->job_title : 'Belum ada jabatan' }}</p>
                    </div>

                    <hr class="my-6 border-slate-100">

                    <div class="space-y-4">
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <x-lucide-mail class="h-4 w-4 text-slate-400" />
                            <span>{{ $user->email }}</span>
                        </div>
                        @if($profile && $profile->phone)
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <x-lucide-phone class="h-4 w-4 text-slate-400" />
                                <span>{{ $profile->phone }}</span>
                            </div>
                        @endif
                        @if($profile && $profile->location)
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <x-lucide-map-pin class="h-4 w-4 text-slate-400" />
                                <span>{{ $profile->location }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Skills -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-base font-bold text-slate-900">Keahlian (Skills)</h3>
                    @if($profile && is_array($profile->skills) && count($profile->skills) > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($profile->skills as $skill)
                                <span class="rounded-lg bg-emerald-50 border border-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    {{ $skill['name'] ?? $skill }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">Belum ada data keahlian.</p>
                    @endif
                </div>

                <!-- CV PDF (Jika Ada) -->
                @if($application->cv_path)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-base font-bold text-slate-900">Dokumen Lampiran</h3>
                    <div class="flex items-center justify-between rounded-xl border border-emerald-100 bg-emerald-50 p-4">
                        <div class="flex items-center gap-3">
                            <x-lucide-file-text class="h-6 w-6 text-emerald-600" />
                            <div>
                                <p class="text-sm font-semibold text-slate-900">CV / Resume (PDF)</p>
                                <p class="text-xs text-slate-500">Dilampirkan pelamar</p>
                            </div>
                        </div>
                        <a href="{{ route('company.cv.download', $application->id) }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-emerald-600 shadow-sm transition hover:bg-emerald-600 hover:text-white border border-emerald-200">
                            <x-lucide-download class="h-4 w-4" />
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Konten Utama: Pengalaman & Pendidikan -->
            <div class="md:col-span-2 space-y-6">
                <!-- Cover Letter / Bio -->
                @if($application->cover_letter || ($profile && $profile->bio))
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="mb-4 text-base font-bold text-slate-900">Ringkasan Diri / Cover Letter</h3>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $application->cover_letter ?? $profile->bio }}
                        </p>
                    </div>
                @endif

                <!-- Pengalaman Kerja -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-6 text-base font-bold text-slate-900">Pengalaman Kerja</h3>
                    @if($profile && is_array($profile->experience) && count($profile->experience) > 0)
                        <div class="space-y-6">
                            @foreach($profile->experience as $exp)
                                <div class="relative pl-6 border-l-2 border-emerald-100">
                                    <div class="absolute -left-1.5 top-1.5 h-3 w-3 rounded-full bg-emerald-500 border-2 border-white"></div>
                                    <h4 class="font-semibold text-slate-900">{{ $exp['title'] ?? 'Posisi' }}</h4>
                                    <div class="text-sm font-medium text-slate-600 mt-0.5">{{ $exp['company'] ?? 'Perusahaan' }}</div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $exp['start_date'] ?? '' }} - {{ $exp['end_date'] ?? 'Sekarang' }}
                                    </div>
                                    @if(isset($exp['description']))
                                        <p class="mt-2 text-sm text-slate-600">{{ $exp['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">Belum ada pengalaman kerja.</p>
                    @endif
                </div>

                <!-- Pendidikan -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-6 text-base font-bold text-slate-900">Riwayat Pendidikan</h3>
                    @if($profile && is_array($profile->education) && count($profile->education) > 0)
                        <div class="space-y-6">
                            @foreach($profile->education as $edu)
                                <div class="relative pl-6 border-l-2 border-emerald-100">
                                    <div class="absolute -left-1.5 top-1.5 h-3 w-3 rounded-full bg-emerald-500 border-2 border-white"></div>
                                    <h4 class="font-semibold text-slate-900">{{ $edu['degree'] ?? 'Gelar' }} - {{ $edu['major'] ?? 'Jurusan' }}</h4>
                                    <div class="text-sm font-medium text-slate-600 mt-0.5">{{ $edu['institution'] ?? 'Institusi' }}</div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        Tahun Lulus: {{ $edu['graduation_year'] ?? '-' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500">Belum ada riwayat pendidikan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-company-layout>
