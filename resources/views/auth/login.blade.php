<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Jawara</title>
  @vite('resources/css/app.css')
  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #fdf6f0; }
  </style>
</head>
<body class="flex min-h-screen">
  <!-- Kiri: Form -->
  <div class="w-1/2 flex justify-center items-center bg-white shadow-lg">
    <div class="w-3/4 max-w-sm">
      <h2 class="text-2xl font-bold text-green-700 mb-2">Selamat Datang!</h2>
      <p class="text-gray-600 mb-6">Isi formulir ini untuk masuk ke aplikasi</p>

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
          <label class="block text-sm mb-1">Email</label>
          <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm mb-1">Password</label>
          <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <button type="submit" class="w-full bg-green-700 text-white py-2 rounded-lg mb-4">Masuk</button>
      </form>

      <div class="text-center text-sm text-gray-600 mb-4">
        <a href="#" class="text-green-700">Lupa Password?</a>
      </div>

      <button class="w-full border py-2 rounded-lg flex items-center justify-center gap-2">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
        Masuk dengan Google
      </button>

      <p class="text-center text-sm text-gray-600 mt-4">
        Tidak punya akun? <a href="{{ route('register') }}" class="text-green-700">Daftar</a>
      </p>
    </div>
  </div>

  <!-- Kanan: Ilustrasi -->
  <div class="w-1/2 bg-[#fdf6f0] flex flex-col justify-center items-center p-10">
    <h1 class="text-3xl font-bold">Sugeng rawuh, <span class="text-orange-600">Jawara!</span></h1>
    <p class="text-gray-700 text-center mt-3 max-w-md">
      Lanjutkan petualanganmu dalam belajar Bahasa Jawa dan temukan hal-hal baru setiap harinya.
    </p>
    <img src="{{ asset('images/jawa-illustration.png') }}" alt="Ilustrasi" class="mt-6 w-80">
  </div>
</body>
</html>
