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

<!-- NAVBAR DASHBOARD USER -->
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0]">
    <!-- Logo -->
    <div class="text-3xl font-maragsa text-[#9A3B1B]">
        JAWARA
    </div>

    <!-- Menu Tengah -->
    <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
        <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('home') ? 'text-[#4C9894]' : '' }}">Home</a></li>
        <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('modul') ? 'text-[#4C9894]' : '' }}">Modul</a></li>
        <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('progress') ? 'text-[#4C9894]' : '' }}">Progress Tracker</a></li>
        <li><a href="#" class="hover:text-[#4C9894] {{ request()->is('narahubung') ? 'text-[#4C9894]' : '' }}">Narahubung</a></li>
    </ul>

    <!-- Profil + Garis Tiga -->
    <div class="flex items-center space-x-4">
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

<!-- HERO SECTION -->
<section class="relative text-center pt-48 pb-32 overflow-hidden"> <!-- Tambah padding agar jarak dari navbar pas -->

  <!-- Wayang kiri-kanan + teks utama -->
  <div class="relative flex flex-col lg:flex-row items-center justify-center w-full">

      <!-- Wayang kiri -->
       
      <img src="{{ asset('images/wayang kiri.png') }}" 
           class="absolute left-0 top-1/2 -translate-y-[40%] w-[500px] lg:w-[700px] h-auto object-cover"
           alt="Wayang kiri">

      <!-- ✅ Teks utama sejajar di tengah, dengan jarak aman dari navbar -->
      <div class="z-10 text-center px-8 lg:px-0 mt-10 lg:mt-0">
          <h1 class="text-7xl font-maragsa text-[#171717] leading-tight mb-2">
     <span class="text-[#F4A261]">Bahasa Jawa</span> Gampang
  </h1>
          <h2 class="text-7xl font-maragsa text-[#171717] mb-8">
    Yen Sinau Bareng <span class="text-[#F4A261]">Jawara.</span>
  </h2>

          <p class="text-black-600 max-w-2xl mx-auto text-lg mb-12">
              Yuk, belajar Bahasa Jawa bareng! Seru, interaktif, dan bikin kamu makin mengenal budaya Jawa!
          </p>
      </div>

  


      <!-- Wayang kanan -->
      <img src="{{ asset('images/wayang kanan.png') }}" 
            class="absolute right-0 top-1/2 -translate-y-[40%] w-[500px] lg:w-[700px] h-auto object-cover"
           alt="Wayang Kanan">
  </div>

  <!-- Ornamen awan di bawah (beri jarak aman dari wayang & teks) -->
  <div class="flex justify-between items-center mt-80 px-0">
      <img src="{{ asset('images/awan kiri.png') }}" 
           class="w-[550px] h-auto object-contain translate-y-4" 
           alt="Awan Kiri">
      <img src="{{ asset('images/awan kanan.png') }}" 
           class="w-[550px] h-auto object-contain translate-y-4" 
           alt="Awan Kanan">
  </div>
</section>


<!-- MODUL SECTION -->
<section class="text-center mt-0 mb-24">
  <h2 class="text-5xl font-maragsa text-[#171717] mb-12">
    Ayo! Latih Bahasa Jawamu di <span class="text-[#F4A261]">Jawara.</span>
  </h2>

  <div class="flex flex-col items-center gap-6">
    @foreach (range(1, 4) as $i)
    <div class="flex items-center bg-white shadow-lg rounded-xl w-[60%] p-5 justify-between hover:shadow-xl transition">
      <div class="flex items-center gap-5">
        <img src="{{ asset('images/aksara.png') }}" alt="Aksara Jawa" class="w-16 h-16">
        <div class="text-left">
          <h3 class="text-lg font-semibold text-[#171717]">Modul {{ $i }}: Belajar Aksara Jawa</h3>
          <p class="text-sm text-gray-500 mb-3">Mulai latihan menulis dan membaca aksara dasar</p>

          <!-- ✅ Tambahkan tiga tombol kecil -->
          <div class="flex gap-2">
            <a href="#" class="bg-[#F4A261] text-white text-sm px-3 py-1 rounded-full hover:bg-[#3A7773] transition">Materi</a>
            <a href="#" class="bg-[#F4A261] text-white text-sm px-3 py-1 rounded-full hover:bg-[#3A7773] transition">Flashcard</a>
            <a href="#" class="bg-[#F4A261] text-white text-sm px-3 py-1 rounded-full hover:bg-[#3A7773] transition">Game</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>
{{-- FOOTER --}}
  @include('layoutscomponents.footer')


