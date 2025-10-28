<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Refleksi | Jawara</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF7EE;
      overflow-x: hidden;
    }
    .font-jawara {
      font-family: 'Playfair Display', serif;
    }
  </style>
</head>

<body class="relative min-h-screen flex flex-col">

  {{-- HEADER --}}
  <header class="flex justify-between items-center px-10 py-6 bg-transparent relative z-20">
    <h1 class="text-3xl font-extrabold text-[#6B3E12] tracking-wide font-jawara">JAWARA</h1>
    <nav class="flex items-center space-x-8 text-sm text-gray-700">
      <a href="#" class="hover:text-amber-600 transition">Home</a>
      <a href="#" class="hover:text-amber-600 transition">Modul</a>
      <a href="#" class="hover:text-amber-600 transition">Progress Tracker</a>
      <a href="#" class="hover:text-amber-600 transition">Narahubung</a>
    </nav>

    {{-- Profil dan Logout --}}
    <div class="flex items-center space-x-4">
      <img src="{{ asset('images/profile.jpg') }}" class="w-10 h-10 rounded-full border-2 border-amber-500 object-cover" alt="User">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-1 rounded-lg transition">Keluar</button>
      </form>
    </div>
  </header>

  {{-- ISI UTAMA --}}
  <main class="relative flex-1 flex justify-center items-center px-10 py-16">

    {{-- Ilustrasi Kiri --}}
    <img src="{{ asset('images/orang menari cewe.png') }}" class="absolute left-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="Penari Cewek">

    {{-- Ilustrasi Kanan --}}
    <img src="{{ asset('images/orang menari cowo.png') }}" class="absolute right-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="Penari Cowok">

    {{-- KONTEN REFLEKSI --}}
    <div class="relative bg-white shadow-xl rounded-2xl w-full max-w-5xl p-10 z-10">

      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Refleksi Pembelajaran</h2>

      {{-- Pilih Modul --}}
      <div class="mb-6">
        <label for="modul" class="block text-sm font-medium text-gray-700 mb-1">Pilih Modul</label>
        <select id="modul" name="modul" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
          <option disabled selected>Pilih Modul...</option>
          <option value="modul1">Modul 1</option>
          <option value="modul2">Modul 2</option>
        </select>
      </div>

      {{-- Textarea --}}
      <div class="mb-6">
        <label for="refleksi" class="block text-sm font-medium text-gray-700 mb-1">Tuliskan Refleksi Anda</label>
        <textarea id="refleksi" name="refleksi" rows="5" placeholder="Ceritakan apa yang Anda pelajari dari modul ini..."
          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none resize-none"></textarea>
      </div>

      {{-- Tombol --}}
      <div class="flex justify-end space-x-3">
        <button id="batalBtn" class="px-5 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition">Batal</button>
        <button id="simpanBtn" class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">Simpan</button>
      </div>
    </div>

    {{-- MODAL KONFIRMASI --}}
<div id="modalKonfirmasi"
     class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white rounded-xl shadow-lg p-8 w-[650px] text-center">
    <p class="text-gray-800 mb-6 text-lg">
      Apakah Anda yakin ingin menyimpan catatan refleksi tersebut?
    </p>
    <div class="flex justify-end space-x-3">
      <button id="tidakBtn"
              class="px-4 py-2 border border-emerald-600 text-emerald-600 rounded-lg hover:bg-emerald-50 transition">
        Tidak
      </button>
      <button id="yakinBtn"
              class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
        Yakin
      </button>
    </div>
  </div>
</div>

  </main>

  @vite(['resources/css/app.css', 'resources/js/reflection.js'])

    </div>
</div>

</body>
</html>
