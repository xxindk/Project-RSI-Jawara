<footer class="bg-gradient-to-b from-[#6B341D] to-[#B37551] text-white py-12 px-6 md:px-24 font-poppins relative overflow-hidden">

  {{-- Tambahkan font khusus hanya untuk footer --}}
  <style>
    @font-face {
      font-family: 'Maragsa';
      src: url('{{ asset('fonts/Maragsa-Display.woff2') }}') format('woff2'),
           url('{{ asset('fonts/Maragsa-Display.woff') }}') format('woff'),
           url('{{ asset('fonts/Maragsa-Display.otf') }}') format('opentype');
      font-weight: normal;
      font-style: normal;
    }

    .font-maragsa {
      font-family: 'Maragsa', serif;
      letter-spacing: 0.05em;
    }
  </style>

  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
    <!-- Logo & About -->
    <div>
      <h2 class="text-3xl font-maragsa mb-3 tracking-wide">JAWARA</h2>
      <p class="text-sm leading-relaxed mb-5 max-w-xs">
        Tempat belajar Bahasa Jawa untuk generasi masa kini dengan cara yang seru,
        interaktif, dan mudah dipahami oleh semua kalangan.
      </p>

     <div class="flex space-x-3">
  <a href="#" class="border border-white rounded-md p-2 hover:bg-white transition">
    <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-5 h-5 object-contain hover:brightness-75">
  </a>

  <a href="#" class="border border-white rounded-md p-2 hover:bg-white transition">
    <img src="{{ asset('images/twitter.png') }}" alt="Twitter" class="w-5 h-5 object-contain hover:brightness-75">
  </a>

  <a href="#" class="border border-white rounded-md p-2 hover:bg-white transition">
    <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn" class="w-5 h-5 object-contain hover:brightness-75">
  </a>

  <a href="#" class="border border-white rounded-md p-2 hover:bg-white transition">
    <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-5 h-5 object-contain hover:brightness-75">
  </a>
</div>
</div>

    <!-- Home -->
    <div>
      <h3 class="font-semibold text-lg mb-3">Home</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:underline">Modul</a></li>
        <li><a href="#" class="hover:underline">Flashcard</a></li>
        <li><a href="#" class="hover:underline">Game</a></li>
        <li><a href="#" class="hover:underline">Progress Tracker</a></li>
      </ul>
    </div>

    <!-- Resources -->
    <div>
      <h3 class="font-semibold text-lg mb-3">Resources</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:underline">Konten Pembelajaran</a></li>
        <li><a href="#" class="hover:underline">Media Pengingat Kosakata</a></li>
        <li><a href="#" class="hover:underline">Permainan Interaktif</a></li>
        <li><a href="#" class="hover:underline">Perkembangan Belajar</a></li>
      </ul>
    </div>

    <!-- Contact -->
    <div>
      <h3 class="font-semibold text-lg mb-3">Contact Us</h3>
      <p class="text-sm mb-4">jawara@gmail.com</p>

      <div>
        <label for="lang" class="font-semibold block text-sm mb-2">Language</label>
        <select id="lang" class="text-black px-3 py-2 rounded-md focus:outline-none font-semibold text-sm w-50">
          <option>BAHASA INDONESIA</option>
        </select>
      </div>
    </div>
  </div>

  <div class="text-center text-xs mt-10 text-gray-200">
    © 2025 Jawara. All rights reserved.
  </div>
</footer>
