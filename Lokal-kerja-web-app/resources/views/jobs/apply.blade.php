<x-job-layout title="Ajukan Lamaran: {{ $job->title }}">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        
        <a href="{{ route('jobs.show', $job->id) }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-[#13391e] transition-colors">
            <x-lucide-arrow-left class="h-4 w-4" /> Batal & Kembali ke Detail
        </a>

        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Kirim Lamaran Pekerjaan</h1>
            <p class="mt-2 text-slate-600">
                Pastikan informasi Anda sudah benar sebelum mengirimkan lamaran ke 
                <span class="font-bold text-[#13391e]">
                    {{ $job->company->name ?? 'Perusahaan Rahasia' }}
                </span>.
            </p>
        </div>

        <form action="{{ route('jobs.apply.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Review Profil -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm transition-all hover:border-slate-900">
                <h2 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                    <x-lucide-user-circle class="h-5 w-5 text-[#13391e]" /> Profil Anda yang akan dikirim
                </h2>
                
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#13391e]/10 text-3xl font-bold text-[#13391e] flex-shrink-0">
                        {{ substr($user->name, 0, 1) }}
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $user->name }}</h3>
                        <p class="text-sm font-medium text-slate-500">{{ $user->profile->job_title ?? 'Belum mengatur spesialisasi pekerjaan' }}</p>
                        
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-slate-600">
                            <div class="flex items-center gap-2">
                                <x-lucide-mail class="h-4 w-4 text-slate-400" />
                                {{ $user->email }}
                            </div>

                            <div class="flex items-center gap-2">
                                <x-lucide-phone class="h-4 w-4 text-slate-400" />
                                {{ $user->profile->phone ?? 'Belum ada nomor telepon' }}
                            </div>

                            <div class="flex items-center gap-2">
                                <x-lucide-map-pin class="h-4 w-4 text-slate-400" />
                                {{ $user->profile->location ?? 'Belum ada lokasi' }}
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('jobs.profile') }}" target="_blank" class="text-sm font-semibold text-[#13391e] hover:text-[#0f2d18] flex items-center gap-1">
                                Ubah Profil Anda <x-lucide-external-link class="h-3 w-3" />
                            </a>
                            <p class="text-xs text-slate-500 mt-1">Perubahan pada profil akan memengaruhi lamaran yang dikirim.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Upload CV & Surat Lamaran -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm transition-all hover:border-slate-900">
                <h2 class="text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                    <x-lucide-file-text class="h-5 w-5 text-[#13391e]" /> Dokumen Lamaran
                </h2>
                
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Unggah CV (Opsional, format PDF maks. 2MB)
                    </label>

                    <p class="text-sm text-slate-500 mb-3">
                        Lampirkan CV atau Resume Anda dalam bentuk PDF jika diperlukan oleh perusahaan.
                    </p>
                    
                    <input 
                        type="file" 
                        name="cv" 
                        accept=".pdf" 
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#13391e]/10 file:text-[#13391e] hover:file:bg-[#13391e]/20 border border-slate-200 rounded-xl bg-slate-50 p-2 cursor-pointer outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900"
                    >
                    
                    @error('cv')
                        <p class="mt-2 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Cover Letter (Opsional)
                    </label>

                    <p class="text-sm text-slate-500 mb-3">
                        Tulis pesan singkat kepada rekruter untuk menjelaskan mengapa Anda adalah kandidat terbaik untuk posisi 
                        <span class="font-bold text-slate-700">{{ $job->title }}</span>.
                    </p>
                    
                    <textarea 
                        name="cover_letter" 
                        rows="6" 
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 placeholder-slate-400" 
                        placeholder="Yth. Bapak/Ibu HRD, ..."
                    >{{ old('cover_letter') }}</textarea>
                    
                    @error('cover_letter')
                        <p class="mt-2 text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 border-t border-slate-200 pt-8">
                <a 
                    href="{{ route('jobs.show', $job->id) }}" 
                    class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-700 hover:border-slate-900 hover:bg-slate-50 transition"
                >
                    Batal
                </a>

                <button 
                    type="submit" 
                    class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-xl bg-[#13391e] px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#0f2d18] active:bg-[#0b2413] transition"
                >
                    <x-lucide-send class="h-4 w-4" /> Kirim Lamaran
                </button>
            </div>
            
        </form>

    </div>
</x-job-layout>