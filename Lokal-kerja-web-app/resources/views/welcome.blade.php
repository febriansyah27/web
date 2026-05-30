<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokalKerja Temukan Pekerjaan Impian di Kota Palu</title>
    <meta name="description" content="Platform pencarian kerja lokal yang menghubungkan talenta dan industri di Palu, Indonesia.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --color-primary: #450000; }
        body { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: var(--color-primary); }
        .text-primary { color: var(--color-primary); }
        .border-primary { border-color: var(--color-primary); }
        .hover\:text-primary:hover { color: var(--color-primary); }
        .hover\:bg-primary:hover { background-color: var(--color-primary); }

        /* Hero: Gambar + overlay ungu gelap yang menyatu */
        .hero-section {
            position: relative;
            background-color: var(--color-primary);
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('/img/gambar pekerja.png');
            background-size: cover;
            background-position: center right;
            opacity: 0.18;
            z-index: 0;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to right,
                rgba(249, 35, 213, 0.56) 0%,
                rgba(225, 32, 109, 0.85) 50%,
                rgba(188, 28, 87, 0.55) 100%
            );
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="/" class="text-xl font-extrabold tracking-tight text-primary">LokalKerja</a>
                <div class="hidden md:flex items-center gap-8">
                    <a href="#kategori" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">Cari Lowongan</a>
                    <a href="#mengapa" class="text-sm font-medium text-slate-600 hover:text-primary transition-colors">Tentang Kami</a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('auth.login') }}" class="hidden sm:inline-block text-sm font-semibold text-slate-700 hover:text-primary transition-colors px-4 py-2 rounded-lg hover:bg-slate-100">Login</a>
                    <a href="{{ route('auth.register') }}" class="inline-flex items-center justify-center rounded-lg bg-primary px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:opacity-90 transition-opacity">Daftar</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Hero Section dengan gambar background samar -->
    <section class="hero-section pt-28 pb-20 sm:pt-36 sm:pb-28">
        <div class="hero-content mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <h1 data-aos="fade-up" data-aos-offset="-9999" data-aos-duration="900" class="text-4xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Temukan Pekerjaan Di<br>Kota Palu
                </h1>
                <p class="mt-5 text-base sm:text-lg text-indigo-200 leading-relaxed max-w-xl">
                    Akses ribuan peluang kerja lokal yang sesuai dengan keahlian dan lokasi Anda. Mulai langkah baru hari ini bersama LokalKerja.
                </p>

                <!-- Search Bar -->
                <div class="mt-10">
                    @auth
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-8 py-4 text-sm font-bold text-primary shadow-lg hover:bg-indigo-50 transition">
                            Mulai Cari Lowongan
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-3 rounded-2xl bg-white/10 backdrop-blur-sm p-2 border border-white/20">
                            <div class="relative flex-1">
                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                <input type="text" placeholder="Jabatan atau Kata Kunci..." class="w-full rounded-xl bg-white py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none placeholder-slate-400">
                            </div>
                            <a href="{{ route('auth.login') }}" class="shrink-0 inline-flex items-center justify-center rounded-xl bg-primary px-8 py-3.5 text-sm font-bold text-white shadow-md hover:opacity-90 transition border border-white/20">
                                Cari Kerja
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Stats Section -->
    <section class="bg-white border-b border-slate-200 shadow-sm" >
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-3 divide-x divide-slate-200">
                <div class="py-8 text-center">
                    <div class="text-3xl font-extrabold text-primary">{{ number_format($totalJobs, 0, ',', '.') }}</div>
                    <div class="mt-1 text-xs sm:text-sm text-slate-500 font-medium">Lowongan Aktif</div>
                </div>
                <div class="py-8 text-center">
                    <div class="text-3xl font-extrabold text-primary">{{ number_format($totalCompanies, 0, ',', '.') }}</div>
                    <div class="mt-1 text-xs sm:text-sm text-slate-500 font-medium">Perusahaan</div>
                </div>
                <div class="py-8 text-center">
                    <div class="text-3xl font-extrabold text-primary">{{ number_format($totalSeekers, 0, ',', '.') }}</div>
                    <div class="mt-1 text-xs sm:text-sm text-slate-500 font-medium">Pencari Kerja</div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Stats Section -->


    <!-- Lowongan Unggulan -->
    <section class="py-16 bg-white mt-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8" data-aos="zoom-in-down">
                <h2 class="text-2xl font-extrabold text-slate-900">Lowongan Unggulan</h2>
                <p class="mt-1 text-sm text-slate-500">Lowongan terbaru dari perusahaan terpilih</p>
            </div>

            @if($featuredJobs->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($featuredJobs as $job)
                        <div class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5" data-aos="flip-left"
                    data-aos-easing="ease-out-cubic"
                    data-aos-duration="2000">
                            <div class="flex items-start gap-4 mb-4" >
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white font-extrabold text-base" >
                                    {{ strtoupper(substr($job->company->name ?? 'L', 0, 2)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-slate-900 truncate text-sm">{{ $job->title }}</h3>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $job->company->name ?? 'Perusahaan' }}</p>
                                </div>
                                <span class="shrink-0 inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">Terbuka</span>
                            </div>
                            <div class="flex flex-wrap gap-3 mb-4 text-xs text-slate-500">
                                <span class="flex items-center gap-1">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ Str::limit($job->location, 18) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $job->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">{{ $job->type }}</span>
                                @if($job->salary)
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ Str::limit($job->salary, 15) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('auth.login') }}" class="mt-auto block text-center rounded-xl border border-primary py-2.5 text-xs font-bold text-primary transition hover:bg-primary hover:text-white">
                                Lamar Sekarang
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50 py-16 text-center">
                    <svg class="h-12 w-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    <p class="text-sm font-medium text-slate-500">Belum ada lowongan aktif saat ini.</p>
                    <a href="{{ route('auth.register') }}" class="mt-4 text-sm font-semibold text-primary hover:underline">Daftarkan perusahaan Anda →</a>
                </div>
            @endif

            <div class="mt-8 text-center" data-aos="fade-right" data-aos-easing="ease-in-sine">
                @auth
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-8 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition">
                        Lihat Semua Lowongan
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                @else
                    <a href="{{ route('auth.login') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-8 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition">
                        Lihat Semua Lowongan
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>
    <!-- End Lowongan Unggulan -->

    <!-- Kenapa LokalKerja? -->
    <section id="mengapa" class="py-20 bg-slate-50">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <h2 class="text-2xl font-extrabold text-slate-900" data-aos="fade-up" data-aos-anchor-placement="center-bottom">Kenapa LokalKerja?</h2>
                <p class="mt-2 text-sm text-slate-500 max-w-md mx-auto">Platform pencarian kerja yang difokuskan khusus untuk mempertemukan talenta dan industri di Kota Palu.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center px-4"  data-aos="zoom-out-left">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-100 mb-5">
                        <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Fokus Lokal</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Temukan lowongan yang benar-benar lokal dengan kampung halaman Anda untuk efisiensi mobilitas.</p>
                </div>
                <div class="flex flex-col items-center text-center px-4"  data-aos="zoom-out-left">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-100 mb-5">
                        <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Mudah Digunakan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Proses pendaftaran dan pelamaran yang ringkas, tanpa birokrasi digital yang rumit.</p>
                </div>
                <div class="flex flex-col items-center text-center px-4"  data-aos="zoom-out-left">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-100 mb-5">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">AI CV Generator</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Buat CV profesional secara otomatis yang dibantu oleh teknologi AI kami.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kenapa LokalKerja -->

    <!-- CTA Banner -->
    <section class="bg-primary py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white" data-aos="fade-right">Siap Memulai Perjalanan Karir Anda?</h2>
            <p class="mt-3 text-indigo-200 text-sm sm:text-base" data-aos="fade-left">Bergabunglah bersama para pencari kerja yang telah menemukan peluang terbaik mereka di Palu.</p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-right" data-aos-easing="ease-in-sine">
                <a href="{{ route('auth.register') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-3.5 text-sm font-bold text-primary shadow-md hover:bg-indigo-50 transition">
                    Daftar Gratis Sekarang
                </a>
                <a href="{{ route('auth.register') }}" class="inline-flex items-center justify-center rounded-xl border border-white/40 px-8 py-3.5 text-sm font-bold text-white hover:bg-white/10 transition">
                    Pasang Lowongan
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    <!-- End CTA Banner -->

    <!-- Footer -->
    <footer class="bg-slate-900 py-10 text-center">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <a href="/" class="text-2xl font-extrabold text-white tracking-tight">LokalKerja</a>
            <p class="mt-3 text-sm text-slate-400">Platform pencarian kerja lokal terpercaya di Palu, Indonesia.</p>
            <p class="mt-6 text-xs text-slate-600">&copy; {{ date('Y') }} LokalKerja. All rights reserved.</p>
        </div>
    </footer>


</body>
</html>
