<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Refleksi | Jawara</title>
  
  <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Maragsa&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background-color: #FFF7F0;
      font-family: 'Inter', sans-serif;
    }
    .font-maragsa {
      font-family: 'Maragsa', serif;
      letter-spacing: 0.5px;
      font-weight: 400;
    }
  </style>
  </style>
</head>

<body class="relative min-h-screen flex flex-col">

<!-- NAVBAR DASHBOARD USER -->
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] z-20">
  <!-- Logo -->
  <div class="text-3xl font-maragsa text-[#9A3B1B]">
      JAWARA
  </div>

  <!-- Menu Tengah -->
    <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
      <li><a href="{{ url('/dashboard-user') }}" class="hover:text-[#4C9894]">Home</a></li>
      <li><a href="{{ url('/dashboard-user') }}" class="hover:text-[#4C9894]">Modul</a></li>
      <li><a href="{{ route('progress.index') }}" class="hover:text-[#4C9894]">Progress Tracker</a></li>
      <li><a href="{{ route('reflection.list') }}" class="hover:text-[#4C9894]">Riwayat Refleksi</a></li>
    </ul>

  <!-- Profil + Garis-Tiga -->
  <div class="flex items-center space-x-4 relative">

      <!-- Foto profil user -->
      <img src="{{ asset('images/profil user.png') }}"
           alt="User Avatar"
           class="w-10 h-10 rounded-full object-cover border border-gray-300">

      <!-- Icon Garis Tiga -->
      <button id="menuToggle" class="flex flex-col justify-between w-6 h-4 focus:outline-none">
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      </button>

      <!-- Dropdown Menu -->
      <div id="dropdownMenu"
           class="hidden absolute top-14 right-0 bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
          
          <!-- Profil -->
          <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
              <img src="{{ asset('images/Vector profil.png') }}" class="w-5 h-5 mr-3">
              Profil
          </a>

          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
                  <img src="{{ asset('images/Vector logout.png') }}" class="w-5 h-5 mr-3">
                  Logout
              </button>
          </form>
      </div>
  </div>
</nav>

<script>
const toggleBtn = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');

toggleBtn.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});

// Klik di luar menu untuk nutup
document.addEventListener('click', (e) => {
    if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
</script>

  {{-- ISI UTAMA --}}
  <main class="relative flex-1 px-10 py-16 flex flex-col items-center">
    {{-- Ilustrasi kiri dan kanan --}}
    <img src="{{ asset('images/orang menari cewe.png') }}" class="absolute left-0 bottom-0 w-80 opacity-90 pointer-events-none" alt="">
    <img src="{{ asset('images/orang menari cowo.png') }}" class="absolute right-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">

    <div class="relative bg-white bg-opacity-80 backdrop-blur-sm rounded-2xl shadow-xl w-full max-w-6xl p-10 z-10">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold text-[#171717]">Refleksi</h2>
        <a href="{{ route('reflection') }}" class="bg-[#3A7773] text-white px-4 py-2 rounded-lg hover:bg-[#3A7773] transition">
          + Tambah Refleksi
        </a>
      </div>

      @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-sm">
          {{ session('success') }}
        </div>
      @endif

      @if($reflections->isEmpty())
        <div class="bg-white border border-gray-200 shadow rounded-xl p-6 text-center text-gray-600">
          Belum ada catatan refleksi yang ditambahkan.
        </div>
      @else
        <div class="space-y-6">
          @foreach($reflections as $reflection)
            <div class="relative bg-white shadow-md rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition">
              <div class="flex items-center mb-2">
                <span class="bg-amber-600 text-white text-sm font-semibold px-4 py-1 rounded-lg">{{ $reflection->modul }}</span>
              </div>
              <p class="text-gray-800 leading-relaxed">{{ $reflection->isi_refleksi }}</p>

              <div class="absolute bottom-3 right-4 flex space-x-3">
                {{-- Tombol Edit --}}
                <a href="{{ route('reflection.edit', $reflection->id) }}" title="Edit Refleksi">
                <img src="{{ asset('images/vector pensil.png') }}" alt="Edit" class="w-4 h-5 object-contain hover:brightness-75">
                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('reflection.destroy', $reflection->id) }}" method="POST" onsubmit="return confirm('Hapus refleksi ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" title="Hapus Refleksi">
                    <img src="{{ asset('images/vector sampah.png') }}" alt="Hapus" class="w-4 h-4 object-contain hover:brightness-75">
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </main>

</body>
</html>
