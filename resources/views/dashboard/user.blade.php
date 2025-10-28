<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jawara | Dashboard User</title>

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

        .hero-padding {
            padding-bottom: 160px;
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- NAVBAR -->
    <nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0]">
        <div class="text-3xl font-maragsa text-[#9A3B1B]">
    JAWARA
</div>
        <ul class="flex gap-10 text-[#171717] font-medium">
            <li><a href="#" class="hover:text-[#4C9894]">Home</a></li>
            <li><a href="#" class="hover:text-[#4C9894]">Modul</a></li>
            <li><a href="#" class="hover:text-[#4C9894]">Progress Tracker</a></li>
            <li><a href="#" class="hover:text-[#4C9894]">About</a></li>
        </ul>
        <a href="/logout" class="text-sm border border-[#4C9894] text-[#4C9894] px-4 py-2 rounded-lg hover:bg-[#4C9894] hover:text-white transition">
            Logout
        </a>
    </nav>

<!-- HERO SECTION -->
<section class="relative text-center pt-48 pb-32 overflow-hidden"> <!-- Tambah padding agar jarak dari navbar pas -->

  <!-- Wayang kiri-kanan + teks utama -->
  <div class="relative flex flex-col lg:flex-row items-center justify-center w-full">

      <!-- Wayang kiri -->
      <img src="{{ asset('images/wayang cowok.png') }}" 
           class="absolute left-0 top-1/2 -translate-y-[40%] w-60 lg:w-72 h-auto object-cover" 
           alt="Wayang Cowok">

      <!-- ✅ Teks utama sejajar di tengah, dengan jarak aman dari navbar -->
      <div class="z-10 text-center px-8 lg:px-0 mt-10 lg:mt-0">
          <h1 class="text-5xl font-maragsa text-[#171717] leading-tight mb-2">
              Bahasa <span class="text-[#9A3B1B]">Jawa</span> Gampang
          </h1>
          <h2 class="text-5xl font-maragsa text-[#4C9894] mb-8">
              Yen Sinau Karo Jawara.
          </h2>

          <p class="text-gray-600 max-w-2xl mx-auto text-lg mb-12">
              Yuk, belajar Bahasa Jawa bareng! Seru, interaktif, dan bikin kamu makin mengenal budaya Jawa!
          </p>
      </div>

      <!-- Wayang kanan -->
      <img src="{{ asset('images/wayang cewek.png') }}" 
           class="absolute right-0 top-1/2 -translate-y-[40%] w-60 lg:w-72 h-auto object-cover" 
           alt="Wayang Cewek">
  </div>

  <!-- Ornamen awan di bawah (beri jarak aman dari wayang & teks) -->
  <div class="flex justify-between items-center mt-48 px-0">
      <img src="{{ asset('images/awan kiri.png') }}" 
           class="w-[650px] h-auto object-contain translate-y-4" 
           alt="Awan Kiri">
      <img src="{{ asset('images/awan kanan.png') }}" 
           class="w-[650px] h-auto object-contain translate-y-4" 
           alt="Awan Kanan">
  </div>
</section>


<!-- MODUL SECTION -->
<section class="text-center mt-6 mb-24"> <!-- Tambah jarak aman dari awan -->
    <h2 class="text-3xl font-maragsa text-[#171717] mb-8">
        Ayo! Latih Bahasa Jawamu di <span class="text-[#9A3B1B]">Jawara</span>.
    </h2>

    <div class="flex flex-col items-center gap-6">
        @foreach (range(1, 4) as $i)
        <div class="flex items-center bg-white shadow-lg rounded-xl w-[60%] p-5 justify-between hover:shadow-xl transition">
            <div class="flex items-center gap-5">
                <img src="{{ asset('images/aksara.png') }}" alt="Aksara Jawa" class="w-16 h-16">
                <div class="text-left">
                    <h3 class="text-lg font-semibold text-[#171717]">Modul {{ $i }}: Belajar Aksara Jawa</h3>
                    <p class="text-sm text-gray-500">Mulai latihan menulis dan membaca aksara dasar</p>
                </div>
            </div>
            <button class="bg-[#4C9894] text-white px-5 py-2 rounded-lg hover:bg-[#3A7773]">Mulai</button>
        </div>
        @endforeach
    </div>
</section>

