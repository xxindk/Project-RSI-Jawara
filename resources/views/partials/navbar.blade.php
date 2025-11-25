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
      <li><a href="{{ url('/dashboard-user') }}" class="hover:text-[#4C9894]">Home</a></li>
      <li><a href="{{ url('/dashboard-user') }}" class="hover:text-[#4C9894]">Modul</a></li>
      <li><a href="{{ route('progress.index') }}" class="hover:text-[#4C9894]">Progress Tracker</a></li>
      <li><a href="{{ route('reflection.list') }}" class="hover:text-[#4C9894]">Riwayat Refleksi</a></li>
    </ul>

    <!-- Profil + Garis Tiga -->
    <div class="flex items-center space-x-4 relative">
        <!-- Foto profil user -->
        <img src="{{ asset($user->foto ?? 'images/profile kosong.jpg') }}" 
             alt="User Avatar" 
             class="navbar-profile w-10 h-10 rounded-full object-cover border border-gray-300">

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
            <button id="showLogoutModal" 
                    class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
                <img src="{{ asset('images/Vector logout.png') }}" alt="Logout Icon" class="w-5 h-5 mr-3">
                Logout
            </button>
        </div>
    </div>
</nav>

<!-- POPUP LOGOUT MODAL -->
<div id="logoutModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-80 text-center transform scale-95 transition-all duration-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Apakah Anda yakin ingin keluar?</h2>
        <div class="flex justify-center gap-4 mt-6">
            <button id="cancelLogout" 
                    class="px-5 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-800 font-medium transition">
                Tidak
            </button>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="px-5 py-2 bg-[#9A3B1B] hover:bg-[#7C2E13] text-white rounded-lg font-medium transition">
                    Ya
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Script Toggle Dropdown & Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const showLogoutModal = document.getElementById('showLogoutModal');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');

        // ✅ Toggle dropdown
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // ✅ Klik di luar dropdown
        document.addEventListener('click', (e) => {
            if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // ✅ Tampilkan popup logout
        showLogoutModal.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation(); // mencegah bubbling
            logoutModal.classList.remove('hidden');
            dropdownMenu.classList.add('hidden');
        });

        // ✅ Tutup popup logout
        cancelLogout.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
        });

        // ✅ Sinkron foto profil
        const navbarProfile = document.querySelector('.navbar-profile');
        window.addEventListener('profileImageChanged', (e) => {
            if (navbarProfile && e.detail && e.detail.newSrc) {
                navbarProfile.src = e.detail.newSrc;
            }
        });
    });
</script>