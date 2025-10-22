<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Jawara</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF7EE;
    }
    .font-jawara {
      font-family: 'Playfair Display', serif;
    }
  </style>
</head>

<body class="flex min-h-screen relative overflow-hidden">

  <!-- Logo di pojok kiri atas -->
  <div class="absolute top-6 left-10">
    <h1 class="text-3xl font-extrabold text-[#6B3E12] tracking-wide">JAWARA</h1>
  </div>

  <!-- Kiri: Form -->
  <div class="w-1/2 flex justify-center items-center z-10">
    <div class="bg-white rounded-2xl shadow-lg w-4/5 max-w-md p-8">
      <h2 class="text-2xl font-semibold text-emerald-700 mb-2">Selamat Datang!</h2>
      <p class="text-gray-600 mb-6 text-sm">Isi formulir ini untuk masuk ke aplikasi</p>

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
          <label class="block text-sm mb-1 text-gray-700">Email</label>
          <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block text-sm mb-1 text-gray-700">Password</label>
          <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
        </div>

        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg font-medium transition">Masuk</button>

        <div class="text-center text-sm text-gray-600 mt-3">
          <a href="#" class="text-emerald-700 hover:underline">Lupa Password?</a>
        </div>

        <div class="flex items-center my-4">
          <hr class="flex-1 border-gray-300">
          <span class="text-gray-500 text-sm mx-2">atau</span>
          <hr class="flex-1 border-gray-300">
        </div>


        <p class="text-center text-sm mt-4 text-gray-700">
          Tidak punya akun?
          <a href="{{ route('register') }}" class="text-emerald-700 font-medium hover:underline">Daftar</a>
        </p>
      </form>
    </div>
  </div>

  <!-- Kanan: Ilustrasi -->
  <div class="w-1/2 flex flex-col items-start justify-center text-left px-16 relative overflow-visible">
    <h1 class="text-5xl font-extrabold mb-3 leading-tight font-jawara">
      <span class="text-gray-900">Sugeng rawuh,</span>
      <span class="text-[#D97706]"> Jawara!</span>
    </h1>
    <p class="text-gray-800 text-lg mb-6 w-3/4">
      Lanjutkan petualanganmu dalam belajar Bahasa Jawa dan temukan hal-hal baru setiap harinya.
    </p>

    <!-- Ilustrasi besar dan naik ke atas -->
    <img 
      src="{{ asset('images/jawara-illustration.png') }}"
      alt="Ilustrasi Jawara"
      class="absolute bottom-[-30px] right-0 w-[520px] scale-110 drop-shadow-lg select-none pointer-events-none"
    >
  </div>

</body>
</html>