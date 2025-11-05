<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF7F0] min-h-screen flex flex-col items-center relative">
  
  <style>
@font-face {
    font-family: 'Maragsa';
    src: url('{{ asset('fonts/Maragsa.ttf') }}') format('truetype');
    font-weight: normal;
    font-style: normal;
}
.font-maragsa {
    font-family: 'Maragsa', serif;
}
</style>

    <!-- NAVBAR DASHBOARD USER -->
    <nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] w-full">
        <!-- Logo -->
        <div class="text-3xl font-maragsa text-[#9A3B1B]">
            JAWARA
        </div>

        <!-- Menu Tengah -->
        <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
            <li><a href="/dashboard-user" class="hover:text-[#4C9894] {{ request()->is('dashboard-user') ? 'text-[#4C9894]' : '' }}">Home</a></li>
            <li><a href="/materi" class="hover:text-[#4C9894] {{ request()->is('materi') ? 'text-[#4C9894]' : '' }}">Modul</a></li>
            <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('progress') ? 'text-[#4C9894]' : '' }}">Progress Tracker</a></li>
            <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('narahubung') ? 'text-[#4C9894]' : '' }}">Narahubung</a></li>
        </ul>

        <!-- Profil + Garis Tiga -->
        <div class="flex items-center space-x-4 relative">
            <!-- Foto profil user -->
            <img src="{{ asset('images/profil user.png') }}" 
                 alt="User Avatar" 
                 class="w-10 h-10 rounded-full object-cover border border-gray-300">

            <!-- Tombol Garis Tiga -->
            <button id="menuToggle" class="flex flex-col justify-between w-6 h-4 focus:outline-none">
                <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
                <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
                <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownMenu" 
                 class="hidden absolute top-14 right-[-1rem] bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
                
                <!-- Profil -->
                <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
                    <img src="{{ asset('images/Vector profil.png') }}" alt="Profil Icon" class="w-5 h-5 mr-3">
                    Profil
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
                        <img src="{{ asset('images/Vector logout.png') }}" alt="Logout Icon" class="w-5 h-5 mr-3">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Script Toggle Dropdown -->
    <script>
        const toggleBtn = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        toggleBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Klik di luar dropdown untuk menutup
        document.addEventListener('click', (e) => {
            if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>

    <!-- Gambar Rumah Adat -->
    <img src="{{ asset('images/rumah adat.png') }}" 
         alt="Rumah Adat"
         class="absolute bottom-0 left-0 w-full object-cover pointer-events-none z-0">

    <!-- Kartu Profil -->
    <div class="bg-white rounded-xl shadow-md p-10 w-[650px] mt-10 z-10 relative">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/profil user.png') }}" 
                     alt="User Avatar"
                     class="w-24 h-24 rounded-full object-cover mb-3">
                <p class="text-lg font-semibold text-[#171717]">
                    {{ $user->nama ?? 'Nama Pengguna' }}
                </p>
            </div>

            <!-- Input Nama -->
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" name="nama" 
                       value="{{ old('nama', $user->nama ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4C9894]">
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input type="email" name="email" 
                       value="{{ old('email', $user->email ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4C9894]">
            </div>

            <!-- Input Password -->
            <div class="mb-6">
                <label class="block text-sm text-gray-600 mb-1">Password Baru (opsional)</label>
                <input type="password" name="password" 
                       placeholder="********"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#4C9894]">
            </div>

            <!-- Tombol Simpan & Batal -->
            <div class="flex justify-end space-x-3">
                <button type="submit" 
                        class="bg-[#4C9894] text-white px-6 py-2 rounded-lg hover:bg-[#3E7E7B] transition">
                    Simpan
                </button>
                <a href="{{ url('/dashboard-user') }}" 
                   class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>
