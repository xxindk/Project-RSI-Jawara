<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar | Jawara</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-[#FFF7EE] min-h-screen flex">

  <!-- Kiri: Form -->
  <div class="w-1/2 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg w-4/5 max-w-md p-8">
      <h2 class="text-2xl font-semibold text-emerald-700 mb-2">Daftar Sekarang</h2>
      <p class="text-gray-600 text-sm mb-6">Isi formulir ini untuk membuat akun</p>

      <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block mb-1 text-sm text-gray-700">Nama</label>
          <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block mb-1 text-sm text-gray-700">Email</label>
          <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
        </div>

        <div class="mb-4">
          <label class="block mb-1 text-sm text-gray-700">Password</label>
          <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-400 focus:outline-none" required>
        </div>

        <p class="text-xs text-gray-500 mb-3">Dengan mengklik daftar, Anda menyetujui syarat dan ketentuan.</p>

        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg font-medium transition">Daftar</button>

        <div class="flex items-center my-4">
          <hr class="flex-1 border-gray-300">
          <span class="text-gray-500 text-sm mx-2">atau</span>
          <hr class="flex-1 border-gray-300">
        </div>

        <button type="button" class="w-full border border-gray-300 py-2 rounded-lg flex items-center justify-center hover:bg-gray-50">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google">
          <span class="text-gray-700 text-sm font-medium">Lanjutkan dengan Google</span>
        </button>

        <p class="text-center text-sm mt-4 text-gray-700">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-emerald-700 font-medium hover:underline">Masuk</a>
        </p>
      </form>
    </div>
  </div>

  <!-- Kanan: Ilustrasi -->
  <div class="w-1/2 flex flex-col items-center justify-center text-center px-10">
    <h1 class="text-4xl font-bold mb-2">
      <span class="text-gray-800">Sugeng rawuh,</span> <span class="text-orange-600">Jawara!</span>
    </h1>
    <p class="text-gray-700 text-lg leading-relaxed mb-6">
      Lanjutkan petualanganmu dalam belajar Bahasa Jawa dan temukan hal-hal baru setiap harinya.
    </p>
    <img src="{{ asset('images/jawara-illustration.png') }}" alt="Ilustrasi Jawara" class="w-80">
  </div>

</body>
</html>
