<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress Tracker | Jawara</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maragsa&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background-color: #FFF7F0;
      font-family: 'Inter', sans-serif;
      background-image: url('{{ asset('images/kawung progress tracker kiri.png') }}'), 
                        url('{{ asset('images/kawung progress tracker kanan.png') }}');
      background-repeat: no-repeat;
      background-position: left bottom, right bottom;
      background-size: 450px, 450px;
    }

    .font-maragsa {
      font-family: 'Maragsa', serif;
      letter-spacing: 0.5px;
      font-weight: 400;
    }
  </style>
</head>

<body class="relative min-h-screen flex flex-col">

  {{-- NAVBAR --}}
  <nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] z-20">
    <div class="text-3xl font-maragsa text-[#9A3B1B]">JAWARA</div>

    <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
      <li><a href="#" class="hover:text-[#4C9894]">Home</a></li>
      <li><a href="#" class="hover:text-[#4C9894]">Modul</a></li>
      <li><a href="{{ route('progress.index') }}" class="hover:text-[#4C9894]">Progress Tracker</a></li>
      <li><a href="{{ route('reflection.list') }}" class="hover:text-[#4C9894]">Riwayat Refleksi</a></li>
    </ul>

    <div class="flex items-center space-x-4 relative">
      <img src="{{ asset('images/profil user.png') }}" alt="User Avatar"
           class="w-10 h-10 rounded-full object-cover border border-gray-300">

      <button id="menuToggle" class="flex flex-col justify-between w-6 h-4 focus:outline-none">
        <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
        <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
        <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      </button>

      <div id="dropdownMenu"
           class="hidden absolute top-14 right-0 bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
        <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
          <img src="{{ asset('images/Vector profil.png') }}" class="w-5 h-5 mr-3"> Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
            <img src="{{ asset('images/Vector logout.png') }}" class="w-5 h-5 mr-3"> Logout
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

  document.addEventListener('click', (e) => {
      if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
      }
  });
  </script>

  {{-- MAIN CONTENT --}}
  <main class="flex-grow px-10 py-10 text-center relative">

    <!-- Judul di kiri sejajar dengan progress bar -->
    <div class="w-full max-w-4xl mx-auto text-left">
      <h1 class="text-2xl font-semibold text-[#171717] mb-10">Progress Tracker</h1>

      <!-- Progress Bar -->
      <div class="relative mb-8">
        <div class="w-full h-4 bg-gray-300 rounded-full">
          <div class="h-4 bg-[#4C9894] rounded-full transition-all duration-500"
               style="width: {{ $progressPercentage }}%;"></div>
        </div>
        <div class="absolute top-[-30px] left-[calc({{ $progressPercentage }}%-20px)]">
          <div class="bg-white shadow-md border border-gray-200 px-2 py-1 text-sm rounded-full font-medium">
            {{ $progressPercentage }}%
          </div>
        </div>
      </div>

      @if($progressPercentage == 0)
        <div class="bg-white border border-gray-200 shadow rounded-xl p-6 text-gray-700 text-center">
          Belum Ada Progress yang Tercatat!
        </div>
      @else
        <div class="bg-white border border-gray-200 shadow rounded-xl p-6">
          <table class="w-full border-collapse">
            <thead>
              <tr class="bg-[#FDF2E9] text-[#9A3B1B] text-left">
                <th class="px-4 py-3 border-b">No</th>
                <th class="px-4 py-3 border-b">Modul</th>
                <th class="px-4 py-3 border-b">Status</th>
                <th class="px-4 py-3 border-b">Tingkatan Bahasa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($moduls as $index => $modul)
                @php
                $progress = $progressData->firstWhere('id_modul', $modul->id_modul);
                @endphp
                <tr class="text-gray-700">
                  <td class="px-4 py-3 border-b">{{ $index + 1 }}</td>
                  <td class="px-4 py-3 border-b">{{ $modul->judul_modul }}</td>
                  <td class="px-4 py-3 border-b">
                    {{ $progress ? ucfirst($progress->status) : 'Belum Dikerjakan' }}
                  </td>
                  <td class="px-4 py-3 border-b">{{ $modul->tingkatan_bahasa ?? '-' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </main>

  {{-- FOOTER --}}
  @include('layoutscomponents.footer')

</body>
</html>
