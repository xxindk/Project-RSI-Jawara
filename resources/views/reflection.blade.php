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

    <div class="flex items-center space-x-4">
      <img src="{{ asset('images/profile.jpg') }}" class="w-10 h-10 rounded-full border-2 border-amber-500 object-cover" alt="User">
      <a href="#" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-1 rounded-lg transition">Keluar</a>
    </div>
  </header>

  {{-- ISI UTAMA --}}
  <main class="relative flex-1 flex justify-center items-center px-10 py-16">
    {{-- Ilustrasi kiri dan kanan --}}
    <img src="{{ asset('images/orang menari cewe.png') }}" class="absolute left-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">
    <img src="{{ asset('images/orang menari cowo.png') }}" class="absolute right-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">

    {{-- KONTEN UTAMA --}}
    <div class="relative bg-white shadow-xl rounded-2xl w-full max-w-5xl p-10 z-10">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Refleksi Pembelajaran</h2>

      <form id="reflectionForm" action="{{ isset($reflection) ? route('reflection.update', $reflection->id) : route('reflection.store') }}" method="POST">
        @csrf
        @if(isset($reflection))
          @method('PUT')
        @endif

        {{-- PILIH MODUL --}}
        <div class="mb-6">
          <label for="modul" class="block text-sm font-medium text-gray-700 mb-1">Pilih Modul</label>
          <select id="modul" name="modul"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            <option disabled {{ !isset($reflection) ? 'selected' : '' }}>Pilih Modul...</option>
            <option value="Modul 1" {{ isset($reflection) && $reflection->modul == 'Modul 1' ? 'selected' : '' }}>Modul 1</option>
            <option value="Modul 2" {{ isset($reflection) && $reflection->modul == 'Modul 2' ? 'selected' : '' }}>Modul 2</option>
          </select>
        </div>

        {{-- TEXTAREA --}}
        <div class="mb-6">
          <label for="isi_refleksi" class="block text-sm font-medium text-gray-700 mb-1">Tuliskan Refleksi Anda</label>
          <textarea id="isi_refleksi" name="isi_refleksi" rows="5"
            placeholder="Ceritakan apa yang Anda pelajari dari modul ini..."
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none resize-none">{{ $reflection->isi_refleksi ?? '' }}</textarea>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-end space-x-3">
          <button type="button" id="batalBtn"
            class="px-5 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition">
            Batal
          </button>
          <button type="button" id="simpanBtn"
            class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
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
          <button id="tidakBtn" class="px-4 py-2 border border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100">Tidak</button>
          <button id="yakinBtn" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Yakin</button>
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
