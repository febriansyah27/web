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

            <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-xl sm:p-8">
                {{-- Kita render markdown dari text balasan AI --}}
                <div id="cvContent" class="cv-paper">
                    {!! Illuminate\Support\Str::markdown($cvText) !!}
                </div>
            </div>
            
            {{-- Hidden textarea untuk mempermudah proses copy --}}
            <textarea id="cvRawText" class="hidden">{{ $cvText }}</textarea>
        </div>
    </div>

    <style>
        .cv-paper {
            max-width: 850px;
            min-height: 1100px;
            margin: 0 auto;
            background: white;
            padding: 48px;
            color: #1f2937;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.7;
        }

        .cv-paper h1 {
            color: #14532d;
            font-size: 34px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 4px solid #14532d;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }

        .cv-paper h2 {
            color: #166534;
            font-size: 18px;
            font-weight: 800;
            margin-top: 30px;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #bbf7d0;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .cv-paper h3 {
            color: #111827;
            font-size: 16px;
            font-weight: 700;
            margin-top: 18px;
            margin-bottom: 4px;
        }

        .cv-paper p {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .cv-paper ul {
            margin-top: 8px;
            margin-bottom: 14px;
            padding-left: 22px;
            list-style-type: disc;
        }

        .cv-paper li {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .cv-paper strong {
            color: #111827;
            font-weight: 700;
        }

        .cv-paper a {
            color: #166534;
            text-decoration: underline;
        }
    </style>

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
