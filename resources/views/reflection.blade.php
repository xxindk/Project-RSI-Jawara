<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Refleksi | Jawara</title>
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
      <li><a href="#" class="hover:text-[#4C9894]">Home</a></li>
      <li><a href="#" class="hover:text-[#4C9894]">Modul</a></li>
      <li><a href="#" class="hover:text-[#4C9894]">Progress Tracker</a></li>
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
  <main class="relative flex-1 flex justify-center items-center px-10 py-16">
    {{-- Ilustrasi kiri dan kanan --}}
    <img src="{{ asset('images/orang menari cewe.png') }}" class="absolute left-0 bottom-0 w-80 opacity-90 pointer-events-none" alt="">
    <img src="{{ asset('images/orang menari cowo.png') }}" class="absolute right-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">

    {{-- KONTEN UTAMA --}}
    <div class="relative bg-white shadow-xl rounded-2xl w-full max-w-5xl p-10 z-10">
      <h2 class="text-2xl font-semibold text-[#171717] mb-6">Refleksi</h2>

      <form id="reflectionForm" action="{{ isset($reflection) ? route('reflection.update', $reflection->id) : route('reflection.store') }}" method="POST">
        @csrf
        @if(isset($reflection))
          @method('PUT')
        @endif

        @error('isi_refleksi')
    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg shadow-sm"> 
        {{ $message }}
    </div>
      @enderror

        {{-- PILIH MODUL --}}
        <div class="mb-6">
          <label for="modul" class="block text-sm font-medium text-gray-700 mb-1">Pilih Modul</label>
          <select id="modul" name="modul"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#3A7773] focus:outline-none">
            <option disabled {{ !isset($reflection) ? 'selected' : '' }}>Pilih Modul...</option>
            <option value="Modul 1" {{ isset($reflection) && $reflection->modul == 'Modul 1' ? 'selected' : '' }}>Modul 1</option>
          </select>
        </div>

        {{-- TEXTAREA --}}
        <div class="mb-6">
          <label for="isi_refleksi" class="block text-sm font-medium text-gray-700 mb-1">Tuliskan Refleksi Anda</label>
          <textarea id="isi_refleksi" name="isi_refleksi" rows="5"
            placeholder="Ceritakan apa yang Anda pelajari dari modul ini..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#3A7773] focus:outline-none resize-none">{{ $reflection->isi_refleksi ?? '' }}</textarea>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-end space-x-3">
          <button type="button" id="batalBtn"
            class="px-5 py-2 border border-[#3A7773] text-[#3A7773] rounded-lg hover:bg-gray-100 transition">
            Batal
          </button>
          <button type="button" id="simpanBtn"
            class="px-5 py-2 bg-[#3A7773] text-white rounded-lg hover:bg-[#3A7773] transition">
            Simpan
          </button>
        </div>
      </form>
    </div>

    {{-- MODAL KONFIRMASI --}}
    <div id="modalKonfirmasi"
      class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
      <div class="bg-white rounded-xl shadow-lg p-8 text-center w-[700px]">
        <p class="text-lg mb-6 font-medium text-gray-800">Apakah Anda yakin ingin menyimpan catatan refleksi tersebut?</p>
        <div class="flex justify-end space-x-3">
          <button id="tidakBtn" class="px-4 py-2 border border-[#3A7773] text-[#3A7773] rounded-lg hover:bg-gray-100">Tidak</button>
          <button id="yakinBtn" class="px-4 py-2 bg-[#3A7773] text-white rounded-lg hover:bg-[#3A7773]">Yakin</button>
        </div>
      </div>
    </div>
  </main>

  {{-- Script --}}
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const simpanBtn = document.getElementById("simpanBtn");
    const batalBtn = document.getElementById("batalBtn");
    const modal = document.getElementById("modalKonfirmasi");
    const yakinBtn = document.getElementById("yakinBtn");
    const tidakBtn = document.getElementById("tidakBtn");
    const form = document.getElementById("reflectionForm");

    // Klik SIMPAN → buka modal
    simpanBtn.addEventListener("click", (e) => {
      e.preventDefault();
      modal.classList.remove("hidden");
    });

    // Klik TIDAK → tutup modal
    tidakBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
    });

    // Klik YAKIN → kirim form
    yakinBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
      form.submit();
    });

    // Klik BATAL → balik ke list refleksi
    batalBtn.addEventListener("click", () => {
      window.location.href = "{{ route('reflection.list') }}";
    });
  });
  </script>
  
</body>
</html>
