<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Refleksi | Jawara</title>
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
  <main class="relative flex-1 px-10 py-16 flex flex-col items-center">
    {{-- Ilustrasi kiri dan kanan --}}
    <img src="{{ asset('images/orang menari cewe.png') }}" class="absolute left-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">
    <img src="{{ asset('images/orang menari cowo.png') }}" class="absolute right-0 bottom-0 w-72 opacity-90 pointer-events-none" alt="">

    <div class="relative bg-white bg-opacity-80 backdrop-blur-sm rounded-2xl shadow-xl w-full max-w-6xl p-10 z-10">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold text-[#6B3E12]">Refleksi</h2>
        <a href="{{ route('reflection') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
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
                <a href="{{ route('reflection.edit', $reflection->id) }}"
                   class="text-amber-600 hover:text-amber-800 text-xl"
                   title="Edit Refleksi">
                  ✏️
                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('reflection.destroy', $reflection->id) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus refleksi ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="text-red-600 hover:text-red-800 text-xl"
                          title="Hapus Refleksi">
                    🗑️
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
