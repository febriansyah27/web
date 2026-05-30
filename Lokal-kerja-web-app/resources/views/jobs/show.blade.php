<x-job-layout title="{{ $job->title }}">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3 text-emerald-800">
                <x-lucide-check-circle class="h-5 w-5 text-emerald-500" />
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 flex items-center gap-3 text-rose-800">
                <x-lucide-alert-circle class="h-5 w-5 text-rose-500" />
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <a href="{{ route('jobs.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <x-lucide-arrow-left class="h-4 w-4" /> Kembali ke Daftar Lowongan
        </a>

        <!-- Header Lowongan -->
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="p-6 sm:p-8">
                <!-- Flex Box Judul & Logo -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        <!-- Logo Perusahaan -->
                        <div class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-2xl border border-slate-200 bg-slate-900 shadow-sm overflow-hidden">
                            <x-lucide-building-2 class="h-10 w-10 text-white" />
                        </div>
                        <!-- End Logo Perusahaan -->
                        
                        <!-- Judul dan Nama Perusahaan -->
                        <div class="flex flex-col  sm:items-start text-center sm:text-left pt-1">
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">{{ $job->title }}</h1>
                            <div class="mt-2 inline-flex items-center rounded-md bg-emerald-50 px-3 py-1 text-sm font-bold text-emerald-700">
                                {{ $job->company->name ?? 'Perusahaan Rahasia' }}
                            </div>
                        </div>
                        <!-- End Judul dan Nama Perusahaan -->
                    </div>
                </div>
                <!-- End Flex Box Judul & Logo -->

                <!-- Meta Informasi (Lokasi, Gaji, dll) -->
                <div class="mt-8 flex flex-wrap items-center justify-center sm:justify-start gap-y-4 gap-x-8 text-sm font-medium text-slate-600 border-t border-slate-100 pt-6">
                    <div class="flex items-center gap-2 mr-2">
                        <x-lucide-map-pin class="h-5 w-5 text-slate-400" />
                        <span>{{ $job->location }}</span>
                    </div>
                    <div class="flex items-center gap-2 ">
                        <x-lucide-banknote class="h-5 w-5 text-slate-400" />
                        <span>{{ $job->salary ?? 'Gaji tidak ditampilkan' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-lucide-briefcase class="h-5 w-5 text-slate-400" />
                        <span>{{ $job->type }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-lucide-clock class="h-5 w-5 text-slate-400" />
                        <span>Diposting {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <!-- End Meta Informasi -->
            </div>
        </div>
        <!-- End Header Lowongan -->

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            
            <!-- Kolom Utama: Detail -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Deskripsi Pekerjaan -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <x-lucide-file-text class="h-5 w-5 text-indigo-600" /> Deskripsi Pekerjaan
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $job->description }}
                    </div>
                </div>
                <!-- End Deskripsi Pekerjaan -->

                

                @if($job->requirements)
                <!-- Persyaratan -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-2 flex items-center gap-2">
                        <x-lucide-award class="h-5 w-5 text-indigo-600" /> Persyaratan
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $job->requirements }}
                    </div>
                </div>
                <!-- End Persyaratan -->
                @endif

            </div>
            <!-- End Kolom Utama: Detail -->

            <!-- Kolom Samping: Aksi Melamar -->
            <div class="space-y-6">
                <!-- Box Ringkasan -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 mb-4">Informasi Lowongan</h3>
                    
                    <ul class="space-y-4 text-sm">
                        <li class="flex justify-between items-center border-b border-slate-100 pb-4">
                            <span class="text-slate-500">Status</span>
                            @if($job->status === 'Aktif')
                                <span class="font-semibold text-emerald-600">Terbuka</span>
                            @else
                                <span class="font-semibold text-rose-600">Ditutup</span>
                            @endif
                        </li>
                        <li class="flex justify-between items-center pb-2">
                            <span class="text-slate-500">Batas Lamaran</span>
                            <span class="font-semibold text-slate-900">
                                {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'Tidak ditentukan' }}
                            </span>
                        </li>
                    </ul>

                    <hr class="my-6 border-slate-100">

                    <!-- Area Melamar -->
                    @if($hasApplied)
                        <div class="flex flex-col items-center justify-center rounded-xl bg-emerald-50 p-4 border border-emerald-200 text-center">
                            <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center mb-3">
                                <x-lucide-check class="h-6 w-6 text-emerald-600" />
                            </div>
                            <h4 class="font-bold text-slate-900">Sudah Dilamar</h4>
                            <p class="mt-1 text-xs text-slate-500">Anda telah mengirimkan lamaran untuk lowongan ini. Semoga berhasil!</p>
                        </div>
                    @elseif($job->status !== 'Aktif')
                        <div class="flex flex-col items-center justify-center rounded-xl bg-rose-50 p-4 border border-rose-200 text-center">
                            <x-lucide-x-circle class="h-8 w-8 text-rose-500 mb-2" />
                            <h4 class="font-bold text-slate-900">Lowongan Ditutup</h4>
                            <p class="mt-1 text-xs text-slate-500">Lowongan ini sudah tidak menerima lamaran baru.</p>
                        </div>
                    @else
                        <div class="mb-4 text-sm text-slate-600 text-center">
                            Pastikan profil dan resume Anda sudah lengkap sebelum melamar posisi ini.
                        </div>
                        <button onclick="window.location.href='{{ route('jobs.apply.create', $job->id) }}'" class="w-full rounded-xl bg-indigo-600 px-4 py-3.5 text-center text-sm font-bold text-white transition hover:bg-indigo-700 active:bg-indigo-800 shadow-md hover:shadow-lg">
                            Ajukan Lamaran
                        </button>
                    @endif
                </div>
                <!-- End Box Ringkasan -->
            </div>
            <!-- End Kolom Samping: Aksi Melamar -->
            
        </div>
        <!-- End Grid Layout -->
    </div>
    <!-- End Main Container -->
</x-job-layout>
