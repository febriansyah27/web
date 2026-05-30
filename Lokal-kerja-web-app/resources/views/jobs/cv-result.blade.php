<x-job-layout title="Hasil Generate CV">
    <div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-950">Hasil Generate CV</h1>
                    <p class="mt-2 text-sm text-slate-500">Berikut adalah CV yang dihasilkan oleh AI berdasarkan profil Anda.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('jobs.profile') }}" class="inline-flex items-center rounded-2xl bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm ring-1 ring-inset ring-slate-300 transition hover:bg-slate-50">
                        Kembali ke Profil
                    </a>
                    <button onclick="copyCvText()" class="inline-flex items-center gap-2 rounded-2xl bg-slate-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                        <x-lucide-copy class="h-4 w-4" /> Copy Text
                    </button>
                    <a href="{{ route('profile.download_cv_pdf') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-900">
                        <x-lucide-download class="h-4 w-4" /> Download PDF
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                {{-- Kita render markdown dari text balasan AI --}}
                <div id="cvContent" class="prose prose-slate max-w-none">
                    {!! Illuminate\Support\Str::markdown($cvText) !!}
                </div>
            </div>
            
            {{-- Hidden textarea untuk mempermudah proses copy --}}
            <textarea id="cvRawText" class="hidden">{{ $cvText }}</textarea>
        </div>
    </div>

    <script>
        function copyCvText() {
            const copyText = document.getElementById("cvRawText");
            copyText.style.display = "block";
            copyText.select();
            document.execCommand("copy");
            copyText.style.display = "none";
            
            alert("Teks CV berhasil disalin ke clipboard!");
        }
    </script>
</x-job-layout>
