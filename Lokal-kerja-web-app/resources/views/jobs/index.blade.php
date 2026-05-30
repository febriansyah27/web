<x-job-layout title="Cari Lowongan Pekerjaan">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        
        <!-- Search Section -->
        <form action="{{ route('jobs.index') }}" method="GET" class="mb-4">
            <div class="flex flex-col gap-4 md:flex-row rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                <!-- Keyword Input -->
                <div class="relative flex-1">
                    <x-lucide-search class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Jabatan atau kata kunci..." class="w-full rounded-xl border-none bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none focus:ring-0">
                </div>
                
                <!-- Location Input -->
                

                <!-- Submit Button -->
                <button type="submit" class="rounded-xl bg-indigo-950 px-8 py-3.5 text-sm font-semibold text-white transition hover:bg-indigo-900 flex-shrink-0">
                    Cari Pekerjaan
                </button>
            </div>

            <!-- Filter Section -->
            <div class="mt-4 flex flex-col gap-4 md:flex-row md:items-end rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <!-- Category -->
                <div class="flex-1">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500">Kategori</label>
                    <select name="category" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 appearance-none">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>

                <!-- Specific Location -->

                <!-- Job Type -->
                <div class="flex-1">
                    <label class="mb-1.5 block text-xs font-semibold text-slate-500">Tipe Pekerjaan</label>
                    <select name="type" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 appearance-none">
                        <option value="">Semua Tipe</option>
                        <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ request('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>

                <!-- Clear Filter -->
                <div class="flex-shrink-0">
                    <a href="{{ route('jobs.index') }}" class="inline-block rounded-xl border border-slate-300 bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Hapus Filter
                    </a>
                </div>
            </div>
        </form>

        <!-- Result Header -->
        <div class="mb-4 mt-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
            <div class="text-sm text-slate-600">
                Menampilkan <span class="font-bold text-slate-900">{{ number_format($totalJobs, 0, ',', '.') }}</span> lowongan kerja
            </div>
        </div>

        <!-- Job List -->
        <div class="space-y-4">
            @forelse($jobs as $job)
                <!-- Job Card with Button -->
                <div class="relative flex flex-col rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md hover:border-indigo-200">
                    
                    <!-- Company Logo Placeholder -->
                    <div class="relative z-20 flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm overflow-hidden border border-slate-800">
                        <x-lucide-building-2 class="h-8 w-8 text-slate-300" />
                    </div>

                    <!-- Job Details -->
                    <div class="flex-1 mt-4">
                        <!-- Title & Company -->
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">
                                {{ $job->title }}
                            </h2>
                            <div class="relative z-20 mt-2 inline-block rounded-md bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                {{ $job->company->name ?? 'Perusahaan Rahasia' }}
                            </div>
                        </div>

                        <!-- Meta Info -->
                        <div class="mt-4 flex flex-wrap items-center gap-y-2 gap-x-6 text-sm font-medium text-slate-500">
                            <div class="flex items-center gap-2">
                                <x-lucide-map-pin class="h-4 w-4 text-slate-400" />
                                <span>{{ $job->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-banknote class="h-4 w-4 text-slate-400" />
                                <span>{{ $job->salary ?? 'Gaji tidak ditampilkan' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-lucide-clock class="h-4 w-4 text-slate-400" />
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Badges -->
                        <div class="mt-5 flex flex-wrap gap-2">
                            <span class="rounded-full bg-blue-50 px-3.5 py-1.5 text-xs font-semibold text-blue-700">
                                {{ $job->type }}
                            </span>
                            
                            @if(stripos($job->location, 'remote') !== false)
                                <span class="rounded-full bg-blue-50 px-3.5 py-1.5 text-xs font-semibold text-blue-700">
                                    Remote
                                </span>
                            @else
                                <span class="rounded-full bg-blue-50 px-3.5 py-1.5 text-xs font-semibold text-blue-700">
                                    On-site
                                </span>
                            @endif
                        </div>

                        <!-- View Details Button -->
                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('jobs.show', $job->id) }}" class="flex-1 rounded-xl bg-indigo-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-900 text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center rounded-2xl border border-slate-200 bg-white py-20 px-6 text-center">
                    <x-lucide-search-x class="h-16 w-16 text-slate-300 mb-4" />
                    <h3 class="text-lg font-bold text-slate-900">Tidak ada lowongan ditemukan</h3>
                    <p class="mt-2 text-sm text-slate-500 max-w-sm">Maaf, kami tidak dapat menemukan lowongan pekerjaan yang sesuai dengan kriteria pencarian Anda. Silakan coba kata kunci lain.</p>
                    <a href="{{ route('jobs.index') }}" class="mt-6 inline-flex items-center justify-center rounded-xl bg-indigo-50 px-5 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                        Reset Pencarian
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $jobs->links('pagination::tailwind') }}
        </div>
        
    </div>
</x-job-layout>