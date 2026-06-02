@props([
    'title',
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>
<body>
    <nav class="mx-auto flex items-center justify-between bg-white shadow-sm py-4 px-45 font-semibold">
            <h2 class="text-2xl font-bold text-primary">LokalKerja</h2>
            <ul class="flex items-center gap-4">
                <a href="#" class="text-gray-800 hover:text-emerald-900 px-4 py-2 rounded-md">Cari Lowongan</a>
                <a
                    href="{{ route('auth.login') }}"
                    class="text-white bg-primary  px-4 py-2 rounded-md transition-all">
                    Login
                </a>
            </ul>
    </nav>

    {{-- Success Notification --}}
    @if(session('success'))
        <div id="successAlert" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-bounce z-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('successAlert').remove()" class="ml-2 font-bold">×</button>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('successAlert');
                if (alert) {
                    alert.remove();
                }
            }, 5000);
        </script>
    @endif

    <main>
        {{ $slot }}
    </main>
</body>
</html>
