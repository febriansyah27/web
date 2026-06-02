<x-company-layout title="Edit Lowongan">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('company.dashboard') }}" class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-emerald-600 transition">
                <x-lucide-arrow-left class="h-4 w-4" /> Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-slate-900">Edit Lowongan</h1>
            <p class="mt-1 text-sm text-slate-500">Perbarui detail lowongan untuk "{{ $job->title }}".</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8">
            <form action="{{ route('company.jobs.update', $job->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-slate-700">
                        Judul Lowongan <span class="text-rose-500">*</span>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        @error('title') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </label>

                    <div class="grid gap-4 md:grid-cols-2">
                        <label class="block text-sm font-medium text-slate-700">
                            Lokasi <span class="text-rose-500">*</span>
                            <input type="text" name="location" value="{{ old('location', $job->location) }}" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            @error('location') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </label>
                        
                        <label class="block text-sm font-medium text-slate-700">
                            Tipe Pekerjaan <span class="text-rose-500">*</span>
                            <select name="type" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                <option value="Full-time" {{ old('type', $job->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('type', $job->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('type', $job->type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('type') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        <label class="block text-sm font-medium text-slate-700">
                            Kisaran Gaji (Opsional)
                            <input type="text" name="salary" value="{{ old('salary', $job->salary) }}" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            @error('salary') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </label>

                        <label class="block text-sm font-medium text-slate-700">
                            Batas Lamaran (Deadline)
                            <input type="date" name="deadline" value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            @error('deadline') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </label>

                        <label class="block text-sm font-medium text-slate-700">
                            Status <span class="text-rose-500">*</span>
                            <select name="status" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                                <option value="Aktif" {{ old('status', $job->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Draft" {{ old('status', $job->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Tutup" {{ old('status', $job->status) == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                            @error('status') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <label class="block text-sm font-medium text-slate-700">
                        Deskripsi Pekerjaan <span class="text-rose-500">*</span>
                        <textarea name="description" rows="4" required class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">{{ old('description', $job->description) }}</textarea>
                        @error('description') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </label>

                    <label class="block text-sm font-medium text-slate-700">
                        Persyaratan (Requirements)
                        <textarea name="requirements" rows="4" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">{{ old('requirements', $job->requirements) }}</textarea>
                        @error('requirements') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </label>

                    <label class="block text-sm font-medium text-slate-700">
                        Tanggung Jawab (Responsibilities)
                        <textarea name="responsibilities" rows="4" class="mt-1.5 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                        @error('responsibilities') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('company.dashboard') }}" class="rounded-xl px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-emerald-900 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-company-layout>
