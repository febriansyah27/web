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
<body class="flex flex-col min-h-screen bg-slate-50">
    <nav class="fixed top-0 left-0 right-0 z-50 w-full mx-auto flex items-center justify-between bg-white shadow-sm py-4 px-4 sm:px-8 md:px-45 font-semibold">
            <h2 class="text-2xl font-bold text-primary">LokalKerja</h2>
            <ul class="flex items-center gap-4">
                <a href="{{route('jobs.index')}}" class="text-gray-800 hover:text-primary px-4 py-2 rounded-md">Cari Lowongan</a>
                <a
                    href="{{route('jobs.profile')}}"
                    class="text-gray-800 hover:text-primary px-4 py-2 rounded-md transition-all">
                    Profile Saya
                </a>
            </ul>
    </nav>

    <main class="pt-20 flex-1">
        {{ $slot }}
    </main>

    <footer class="mt-12 border-t flex justify-evenly border-slate-200 bg-white py-8 text-center shadow-sm">
        <p class="mt-4 text-xs text-slate-500">&copy; {{ date('Y') }} LokalKerja. All rights reserved.</p>
        @auth
            <form action="{{ route('auth.logout') }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-2 text-sm font-semibold text-rose-600 bg-rose-50 rounded-xl hover:bg-rose-100 transition-colors">
                    Logout
                </button>
            </form>
        @endauth
    </footer>
</body>
</html>
