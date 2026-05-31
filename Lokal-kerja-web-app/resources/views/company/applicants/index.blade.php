<x-company-layout title="Daftar Pelamar">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('company.dashboard') }}" class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-indigo-600 transition">
                <x-lucide-arrow-left class="h-4 w-4" /> Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-slate-900">Pelamar: {{ $job->title }}</h1>
            <p class="mt-1 text-sm text-slate-500">Total {{ $applications->count() }} orang telah melamar untuk posisi ini.</p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Kandidat</th>
                            <th scope="col" class="px-6 py-4 font-medium">Tanggal Melamar</th>
                            <th scope="col" class="px-6 py-4 font-medium">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($applications as $app)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 text-indigo-700 font-bold">
                                            {{ substr($app->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-900">{{ $app->user->name }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5">{{ $app->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $app->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($app->status === 'Accepted')
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600 border border-emerald-200">Diterima</span>
                                    @elseif($app->status === 'Rejected')
                                        <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-600 border border-rose-200">Ditolak</span>
                                    @elseif($app->status === 'Reviewed')
                                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600 border border-blue-200">Direview</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600 border border-amber-200">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('company.applicants.show', $app->id) }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100 border border-indigo-200">
                                        Lihat Profil
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-lucide-users class="h-10 w-10 text-slate-300 mb-3" />
                                        <p class="text-base font-medium">Belum ada pelamar</p>
                                        <p class="text-sm">Saat ini belum ada kandidat yang melamar untuk lowongan ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-company-layout>
