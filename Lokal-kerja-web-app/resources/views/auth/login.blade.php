<x-auth-layout title="Login">
    <main class="flex justify-center h-screen items-center" >
        {{-- container --}}
        <form action="{{ route('auth.authenticate') }}" method="POST" class="bg-white w-auto h-auto p-10 rounded-2xl shadow-lg">
            @csrf
            <input type="hidden" name="role" id="role" value="job_seeker">
            {{-- Judul dan deskripsi --}}
            <div class="flex flex-col items-center   ">
                <h2 class="text-primary text-2xl font-bold">Login</h2>
                <p class="text-gray-500">Silahkan masuk ke akun anda</p>
            </div>

            {{-- navigasi pencari kerja dan perusahaan
            <div class="flex justify-evenly w-lg gap-10 rounded-xl font-semibold p-1.5 bg-gray-200 text-primary">
                <button type="button" id="jobBtn" class="bg-white ease-in-out transition-all delay-100 py-3 px-10 rounded-lg role-btn">Pencari Kerja</button>
                <button type="button" id="companyBtn" class="py-3 px-10 rounded-lg  ease-in-out transition-all delay-150 role-btn">Perusahaan</button>
            </div> --}}

            {{-- container email dan kata sandi --}}
            <div class="mt-5">
                {{-- email --}}
                <p class="font-semibold mb-2">Email</p>
                <div class="flex items-center border-gray-300 border-2 p-4 rounded-lg gap-3 mb-2">
                    <x-lucide-mail class="w-5 h-5 text-gray-400"/>
                    <input type="email" name="email" placeholder="nama@email.com" class="focus:outline-none w-full">
                </div>

                <p class="font-semibold mb-2">Kata Sandi</p>
                <div class="flex  border-2 border-gray-300 p-4 rounded-lg gap-3">
                    <x-lucide-lock class="w-5 h-5 text-gray-400"/>
                    <input type="password" name="password" placeholder="********" class="focus:outline-none w-full">
                </div>
            </div>
            {{-- tombol masuk --}}
            <div class="flex flex-col justify-center items-center mt-8">
                    <button type="submit" class="p-5 bg-primary text-white flex w-lg rounded-xl justify-center gap-2 items-center font-semibold hover:bg-emerald-800 hover:gap-3 transition-all ease-in-out delay-200 ">Masuk <x-lucide-square-arrow-right-enter class="w-5 h-5 text-white"/></button>
                <p class="mt-4 text-gray-500"><span>Belum punya akun?</span><a href="/register" class="font-bold text-primary"> Daftar</a></p>
            </div>
        </form>
    </main>


    <script>
        const roleInput = document.getElementById('role');

        const jobBtn = document.getElementById('jobBtn');
        const companyBtn = document.getElementById('companyBtn');

        jobBtn.addEventListener('click', () => {

            roleInput.value = 'job_seeker';

            jobBtn.classList.add('bg-white');
            companyBtn.classList.remove('bg-white');

        });

        companyBtn.addEventListener('click', () => {

            roleInput.value = 'company';

            companyBtn.classList.add('bg-white');
            jobBtn.classList.remove('bg-white');
    });

</script>
</x-auth-layout>
