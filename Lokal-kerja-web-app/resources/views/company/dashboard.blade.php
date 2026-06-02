<x-company-layout title="Company Dashboard">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Halo, {{ auth()->user()->name }}</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola lowongan dan temukan talenta terbaik hari ini.</p>
            </div>
            <a href="{{ route('company.jobs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800 shadow-sm">
                <x-lucide-plus-circle class="h-5 w-5" /> Posting Lowongan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-center gap-3 text-emerald-800">
                <x-lucide-check-circle class="h-5 w-5 text-emerald-500" />
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50">
                    <x-lucide-briefcase class="h-7 w-7 text-emerald-600" />
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Lowongan Aktif</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $activeJobs ?? 0 }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50">
                    <x-lucide-users class="h-7 w-7 text-emerald-600" />
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Pelamar</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalApplicants ?? 0 }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50">
                    <x-lucide-trending-up class="h-7 w-7 text-rose-600" />
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Tingkat Seleksi</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $selectionRate ?? 0 }}%</p>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col items-center justify-between border-b border-slate-200 bg-white px-6 py-5 md:flex-row">
                <h2 class="text-lg font-semibold text-slate-900">Lowongan Saya</h2>
                <div class="mt-4 w-full md:mt-0 md:w-72 relative">
                    <x-lucide-search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                    <input type="text" placeholder="Cari lowongan..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2 pl-10 pr-4 text-sm text-slate-900 outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Judul Lowongan</th>
                            <th scope="col" class="px-6 py-4 font-medium">Jumlah Pelamar</th>
                            <th scope="col" class="px-6 py-4 font-medium">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @if(isset($jobs) && count($jobs) > 0)
                            @foreach($jobs as $job)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-slate-100 border border-slate-200">
                                                <x-lucide-briefcase class="h-6 w-6 text-slate-600" />
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900">{{ $job->title }}</div>
                                                <div class="text-xs text-slate-500 mt-0.5">Diposting {{ $job->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-600">
                                        {{ $job->applications_count ?? 0 }} Pelamar
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($job->status === 'Aktif')
                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600 border border-emerald-200">Aktif</span>
                                        @elseif($job->status === 'Draft')
                                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600 border border-slate-200">Draft</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-600 border border-rose-200">Tutup</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('company.applicants.index', $job->id) }}" class="text-slate-400 hover:text-indigo-600 transition" title="Lihat Pelamar">
                                                <x-lucide-eye class="h-5 w-5" />
                                            </a>
                                            <a href="{{ route('company.jobs.edit', $job->id) }}" class="text-slate-400 hover:text-emerald-600 transition" title="Edit">
                                                <x-lucide-edit-2 class="h-4 w-4" />
                                            </a>
                                            <form action="{{ route('company.jobs.destroy', $job->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-400 hover:text-rose-600 transition" title="Hapus">
                                                    <x-lucide-trash-2 class="h-4 w-4" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-lucide-inbox class="h-10 w-10 text-slate-300 mb-3" />
                                        <p class="text-base font-medium">Belum ada lowongan pekerjaan</p>
                                        <p class="text-sm">Mulai memposting lowongan untuk menemukan talenta terbaik.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
                @if(isset($jobs) && $jobs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $jobs->links('pagination::tailwind') }}
                @endif
            </div>
        </div>
    </div>
</x-company-layout>
