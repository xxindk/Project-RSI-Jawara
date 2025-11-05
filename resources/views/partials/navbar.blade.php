<!-- resources/views/partials/navbar.blade.php -->

<!-- Import Font Maragsa -->
<link href="https://fonts.googleapis.com/css2?family=Maragsa&display=swap" rel="stylesheet">
<style>
    .font-maragsa {
        font-family: 'Maragsa', serif;
    }
</style>

<!-- NAVBAR DASHBOARD USER -->
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0]">
    <!-- Logo -->
    <div class="text-3xl font-maragsa text-[#9A3B1B] select-none">
        JAWARA
    </div>

    <!-- Menu Tengah -->
    <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
        <li>
            <a href="/home" class="hover:text-[#4C9894] {{ request()->is('home') ? 'text-[#4C9894]' : '' }}">Home</a>
        </li>
        <li>
            <a href="/modul" class="hover:text-[#4C9894] {{ request()->is('modul') ? 'text-[#4C9894]' : '' }}">Modul</a>
        </li>
        <li>
            <a href="/progress" class="hover:text-[#4C9894] {{ request()->is('progress') ? 'text-[#4C9894]' : '' }}">Progress Tracker</a>
        </li>
        <li>
            <a href="/narahubung" class="hover:text-[#4C9894] {{ request()->is('narahubung') ? 'text-[#4C9894]' : '' }}">Narahubung</a>
        </li>
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
             class="hidden absolute top-14 right-0 bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
            
            <!-- Profil -->
            <a href="{{ route('profile') }}" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
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
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        toggleBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
