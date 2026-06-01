<x-auth-layout title="register">

    <!-- Main Content -->
    <div class="flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            
            <!-- Title Section -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Akun Baru</h1>
                <p class="text-gray-600 text-sm">Bergabunglah dengan ribuan profesional di Indonesia.</p>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-6">
                <button 
                    onclick="switchRole('job_seeker')"
                    data-role-tab="job_seeker"
                    class="flex-1 py-3 text-center text-primary border-b-2 border-primary font-semibold transition">
                    Pencari Kerja
                </button>
                <button 
                    onclick="switchRole('company')"
                    data-role-tab="company"
                    class="flex-1 py-3 text-center text-gray-500 border-transparent transition">
                    Perusahaan
                </button>
            </div>

            <!-- Registration Form -->
            <form action="{{ route('auth.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Hidden Role Input -->
                <input type="hidden" id="role_input" name="role" value="job_seeker">

                <!-- Full Name -->
                <div>
                    <label id="name_label" class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="name_input"
                        name="name" 
                        placeholder="Masukkan nama lengkap Anda"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Row -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Kata Sandi</label>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="••••••••"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('password') border-red-500 @enderror"
                            required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi</label>
                        <input 
                            type="password" 
                            name="confirm_password" 
                            placeholder="••••••••"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary @error('confirm_password') border-red-500 @enderror"
                            required>
                        @error('confirm_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start gap-2 mt-4">
                    <input 
                        type="checkbox" 
                        id="agree_terms"
                        name="agree_terms" 
                        value="1"
                        class="mt-1 rounded border-gray-300 focus:border-primary focus:ring-primary @error('agree_terms') border-red-500 @enderror"
                        required>
                    <label for="agree_terms" class="text-gray-600 text-xs">
                        Saya setuju dengan <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
                    </label>
                </div>
                @error('agree_terms')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                
                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-primary text-white font-semibold py-3 rounded-md hover:bg-emerald-800 transition mt-6">
                    Daftar Sekarang
                </button>



            
            </form>

            <!-- Login Link -->
            <p class="text-center text-gray-600 text-sm mt-6">
                Sudah punya akun? <a href="{{ route('auth.login') }}" class="text-primary hover:underline font-semibold">Login</a>
            </p>

        </div>
    </div>

    <script>
        function switchRole(role) {
            document.getElementById('role_input').value = role;
            
            // Update tab styling
            const tabs = document.querySelectorAll('[data-role-tab]');
            tabs.forEach(tab => {
                if (tab.getAttribute('data-role-tab') === role) {
                    tab.classList.remove('text-gray-500', 'border-transparent');
                    tab.classList.add('text-primary', 'border-b-2', 'border-primary', 'font-semibold');
                } else {
                    tab.classList.remove('text-primary', 'border-b-2', 'border-primary', 'font-semibold');
                    tab.classList.add('text-gray-500', 'border-transparent');
                }
            });

            // Update label & placeholder berdasarkan role
            const nameLabel = document.getElementById('name_label');
            const nameInput = document.getElementById('name_input');
            if (role === 'company') {
                nameLabel.textContent = 'Nama Perusahaan';
                nameInput.placeholder = 'Masukkan nama perusahaan Anda';
            } else {
                nameLabel.textContent = 'Nama Lengkap';
                nameInput.placeholder = 'Masukkan nama lengkap Anda';
            }
        }
    </script>
</x-auth-layout>

