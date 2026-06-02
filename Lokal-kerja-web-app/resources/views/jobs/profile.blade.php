<x-job-layout title="Profil Saya">
    @php
        $user = auth()->user();
        $profile = $profile ?? null;
    @endphp

    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-300">
            <div class="flex items-start justify-between gap-4 pb-6">
                <div>
                    <h1 class="text-3xl font-bold text-slate-950">Profil Saya</h1>
                    <p class="mt-2 text-sm text-slate-500">Perbarui informasi akun dan data profil Anda.</p>
                </div>
                <button id="saveButton" type="submit" form="profileForm" disabled class="inline-flex items-center rounded-2xl bg-slate-300 px-6 py-3 text-sm font-semibold text-slate-500 shadow-sm transition hover:shadow-md disabled:cursor-not-allowed">
                    Simpan Perubahan
                </button>
            </div>

            <div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
                
                @if(session('success'))
                    <div class="col-span-full rounded-2xl bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <x-lucide-check-circle class="h-5 w-5 text-green-400" />
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="col-span-full rounded-2xl bg-red-50 p-4 border border-red-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <x-lucide-alert-circle class="h-5 w-5 text-red-400" />
                            </div>
                            <div class="ml-3">
                                @if(session('error'))
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                @endif
                                @if($errors->any())
                                    <ul class="list-inside list-disc text-sm font-medium text-red-800">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3 border-b border-slate-200 pb-4">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-950">
                                <x-lucide-user class="h-5 w-5" />
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-slate-950">Informasi Pribadi</h2>
                                <p class="text-sm text-slate-500">Lengkapi data dasar profil Anda.</p>
                            </div>
                        </div>

                        <form id="profileForm" action="{{ route('profile.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="block text-sm text-slate-600">
                                    Nama Lengkap
                                    <input id="nameInput" type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </label>
                                <label class="block text-sm text-slate-600">
                                    Email
                                    <input id="emailInput" type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="block text-sm text-slate-600">
                                    Nomor Telepon
                                    <input id="phoneInput" type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                </label>
                                <label class="block text-sm text-slate-600">
                                    Alamat
                                    <input id="alamatInput" type="text" name="alamat" value="{{ old('alamat', $profile->alamat ?? '') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                </label>
                            </div>

                            <div class="grid gap-4 md:grid-cols-2">
                                <label class="block text-sm text-slate-600">
                                    Spesialisasi Pekerjaan
                                    <input id="jobTitleInput" type="text" name="job_title" value="{{ old('job_title', $profile->job_title ?? '') }}" placeholder="Misal: Web Developer, Data Analyst" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                </label>
                                <label class="block text-sm text-slate-600">
                                    Lokasi / Kota
                                    <input id="locationInput" type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" placeholder="Misal: Jakarta, Indonesia" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                                </label>
                            </div>

                            <label class="block text-sm text-slate-600">
                                Tentang Saya
                                <textarea id="bioInput" name="bio" rows="5" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" placeholder="Ceritakan singkat tentang pengalaman dan keahlian Anda...">{{ old('bio', $profile->bio ?? '') }}</textarea>
                            </label>
                        </form>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-center justify-between gap-3 border-b border-slate-200 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-950">
                                    <x-lucide-briefcase class="h-5 w-5" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-slate-950">Pengalaman Kerja</h2>
                                    <p class="text-sm text-slate-500">Kelola riwayat kerja Anda.</p>
                                </div>
                            </div>
                            <button type="button" onclick="document.getElementById('modalExperience').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">
                                <x-lucide-plus class="h-4 w-4" /> Tambah
                            </button>
                        </div>

                        <div class="space-y-4">
                            @if(isset($profile) && $profile->experience && count($profile->experience) > 0)
                                @foreach($profile->experience as $index => $exp)
                                <article class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-white text-slate-950 shadow-sm">
                                                <x-lucide-briefcase class="h-5 w-5" />
                                            </div>
                                            <div>
                                                <h3 class="text-base font-semibold text-slate-950">{{ $exp['job_title'] ?? '' }}</h3>
                                                <p class="text-sm text-slate-500">{{ $exp['company_name'] ?? '' }}</p>
                                                <p class="mt-2 text-xs text-slate-400">{{ $exp['start_date'] ?? '' }} - {{ !empty($exp['end_date']) ? $exp['end_date'] : 'Sekarang' }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('profile.experience.destroy', $index) }}" method="POST" onsubmit="return confirm('Hapus pengalaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-rose-500 transition hover:bg-rose-50 hover:text-rose-600">
                                                <x-lucide-trash-2 class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </article>
                                @endforeach
                            @else
                                <p class="text-sm text-slate-500">Belum ada pengalaman kerja ditambahkan.</p>
                            @endif
                        </div>
                    </section>
                </div>

                <div class="space-y-6">
                    <section class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                        <div class="mb-6 flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-950 shadow-sm">
                                <x-lucide-rocket class="h-5 w-5" />
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-slate-950">Optimasi CV AI</h2>
                                <p class="mt-1 text-sm text-slate-500">Pastikan informasi akurat untuk hasil CV profesional.</p>
                            </div>
                        </div>
                        <form action="{{ route('profile.generate_cv') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-800">
                                <x-lucide-rocket class="h-4 w-4" /> Generate CV dengan AI
                            </button>
                        </form>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-center justify-between gap-4 border-b border-slate-200 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-950">
                                    <x-lucide-school class="h-5 w-5" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-slate-950">Pendidikan</h2>
                                </div>
                            </div>
                            <button type="button" onclick="document.getElementById('modalEducation').classList.remove('hidden')" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-950 transition hover:bg-slate-100">
                                <x-lucide-plus class="h-4 w-4" />
                            </button>
                        </div>
                        <div class="space-y-4">
                            @if(isset($profile) && $profile->education && count($profile->education) > 0)
                                @foreach($profile->education as $index => $edu)
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 flex justify-between items-start">
                                    <div class="flex items-start gap-4">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-3xl bg-white text-slate-950 shadow-sm">
                                            <x-lucide-school class="h-5 w-5" />
                                        </div>
                                        <div class="min-w-0">
                                            <h3 class="text-sm font-semibold text-slate-950">{{ $edu['school_name'] ?? '' }}</h3>
                                            @if(!empty($edu['degree']) || !empty($edu['major']))
                                                <p class="mt-1 text-sm text-slate-500">
                                                    {{ $edu['degree'] ?? '' }}{{ !empty($edu['degree']) && !empty($edu['major']) ? ' - ' : '' }}{{ $edu['major'] ?? '' }}
                                                </p>
                                            @endif
                                            <p class="mt-2 text-xs text-slate-400">{{ $edu['start_year'] ?? '' }} - {{ !empty($edu['end_year']) ? $edu['end_year'] : 'Sekarang' }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('profile.education.destroy', $index) }}" method="POST" onsubmit="return confirm('Hapus pendidikan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-rose-500 transition hover:bg-rose-50 hover:text-rose-600">
                                            <x-lucide-trash-2 class="h-4 w-4" />
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            @else
                                <p class="text-sm text-slate-500">Belum ada pendidikan ditambahkan.</p>
                            @endif
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-center gap-3 border-b border-slate-200 pb-4">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-950">
                                <x-lucide-terminal class="h-5 w-5" />
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-slate-950">Keahlian</h2>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 text-sm text-slate-700">
                            @if(isset($profile) && $profile->skills && count($profile->skills) > 0)
                                @foreach($profile->skills as $index => $skill)
                                <span class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2">
                                    {{ $skill }}
                                    <form action="{{ route('profile.skill.destroy', $index) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="transition hover:text-rose-600"><x-lucide-x class="h-4 w-4" /></button>
                                    </form>
                                </span>
                                @endforeach
                            @else
                                <p class="text-sm text-slate-500">Belum ada keahlian ditambahkan.</p>
                            @endif
                        </div>
                        <form action="{{ route('profile.skill.store') }}" method="POST" class="mt-6 relative">
                            @csrf
                            <input type="text" name="skill_name" required placeholder="Tambah keahlian..." class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-950 text-white transition hover:bg-slate-800">
                                <x-lucide-plus class="h-4 w-4" />
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        const saveButton = document.getElementById('saveButton');
        const fields = [
            document.getElementById('nameInput'),
            document.getElementById('emailInput'),
            document.getElementById('phoneInput'),
            document.getElementById('alamatInput'),
            document.getElementById('jobTitleInput'),
            document.getElementById('locationInput'),
            document.getElementById('bioInput'),
        ];

        const initialValues = fields.reduce((values, field) => {
            values[field.id] = field.value;
            return values;
        }, {});

        function updateSaveButton() {
            const hasChanged = fields.some(field => field && field.value !== initialValues[field.id]);
            saveButton.disabled = !hasChanged;
            saveButton.classList.toggle('bg-primary', hasChanged);
            saveButton.classList.toggle('hover:bg-indigo-900', hasChanged);
            saveButton.classList.toggle('text-white', hasChanged);
            saveButton.classList.toggle('bg-slate-300', !hasChanged);
            saveButton.classList.toggle('text-slate-500', !hasChanged);
            saveButton.classList.toggle('cursor-not-allowed', !hasChanged);
        }

        fields.forEach(field => {
            if(field) field.addEventListener('input', updateSaveButton);
        });
        updateSaveButton();
    </script>

    <div id="modalExperience" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 text-xl font-semibold text-slate-950">Tambah Pengalaman Kerja</h2>
            <form action="{{ route('profile.experience.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-slate-600">Perusahaan</label>
                    <input type="text" name="company_name" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                </div>
                <div>
                    <label class="block text-sm text-slate-600">Posisi / Jabatan</label>
                    <input type="text" name="job_title" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-600">Mulai (Bulan/Tahun)</label>
                        <input type="text" name="start_date" placeholder="Jan 2021" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600">Selesai (Opsional)</label>
                        <input type="text" name="end_date" placeholder="Kosongkan jika sekarang" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalExperience').classList.add('hidden')" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                    <button type="submit" class="rounded-2xl bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Pendidikan -->
    <div id="modalEducation" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm transition-opacity">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 text-xl font-semibold text-slate-950">Tambah Pendidikan</h2>
            <form action="{{ route('profile.education.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-slate-600">Nama Instansi (Sekolah / Universitas)</label>
                    <input type="text" name="school_name" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-600">Gelar (Opsional)</label>
                        <input type="text" name="degree" placeholder="S1, D3 (Kosongkan jika SMA/SMP)" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600">Jurusan (Opsional)</label>
                        <input type="text" name="major" placeholder="IPA, Teknik Komputer" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-slate-600">Tahun Mulai</label>
                        <input type="number" name="start_year" required placeholder="2018" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                    <div>
                        <label class="block text-sm text-slate-600">Tahun Selesai (Opsional)</label>
                        <input type="number" name="end_year" placeholder="2021" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-400 focus:ring-1 focus:ring-slate-300" />
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalEducation').classList.add('hidden')" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Batal</button>
                    <button type="submit" class="rounded-2xl bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-job-layout>
