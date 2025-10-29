<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF5EB] min-h-screen flex flex-col">

    {{-- ✅ Navbar diletakkan di luar container utama agar tampil di atas --}}
    @include('partials.navbar')

    <!-- Konten Profil -->
    <main class="flex justify-center items-center flex-1 w-full mt-8">
        <div class="bg-white p-8 rounded-lg shadow-md flex items-center space-x-12 w-[60%]">
            <!-- Bagian kiri: foto -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    <img src="{{ asset('images/profil user.png') }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover">
                    <button class="absolute bottom-0 right-0 bg-gray-200 rounded-full p-1 border">
                        <img src="{{ asset('images/icon-camera.png') }}" class="w-5 h-5">
                    </button>
                </div>
                <p class="mt-3 font-medium text-gray-700">Felalea Miren</p>
            </div>

            <!-- Bagian kanan: form -->
            <div class="flex flex-col space-y-4 w-1/2">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Nama</label>
                    <input type="text" class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-amber-300 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-amber-300 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" class="w-full border rounded-lg p-2 mt-1 focus:ring-2 focus:ring-amber-300 focus:outline-none">
                </div>
            </div>
        </div>
    </main>

    <!-- Footer ilustrasi -->
    <div class="relative w-full mt-10">
        <img src="{{ asset('images/keraton.png') }}" class="w-full" alt="Keraton">
    </div>

    <script>
        const toggleBtn = document.getElementById('menuToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (toggleBtn && dropdownMenu) {
            toggleBtn.addEventListener('click', () => dropdownMenu.classList.toggle('hidden'));
            document.addEventListener('click', (e) => {
                if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    </script>

</body>
</html>
