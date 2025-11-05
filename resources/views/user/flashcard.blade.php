<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flashcard User - JAWARA</title>
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
  </style>
</head>

<body class="relative min-h-screen flex flex-col">

<!-- NAVBAR DASHBOARD USER -->
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] z-20">
  <!-- Logo -->
  <div class="text-3xl font-maragsa text-[#9A3B1B]">
      JAWARA
  </div>

  <!-- Menu Tengah -->
  <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
      <li><a href="#" class="hover:text-[#4C9894]">Home</a></li>
      <li><a href="#" class="hover:text-[#4C9894]">Modul</a></li>
      <li><a href="#" class="hover:text-[#4C9894]">Progress Tracker</a></li>
      <li><a href="{{ route('reflection.list') }}" class="hover:text-[#4C9894]">Riwayat Refleksi</a></li>
  </ul>

  <!-- Profil + Garis-Tiga -->
  <div class="flex items-center space-x-4 relative">

      <!-- Foto profil user -->
      <img src="{{ asset('images/profil user.png') }}"
           alt="User Avatar"
           class="w-10 h-10 rounded-full object-cover border border-gray-300">

      <!-- Icon Garis Tiga -->
      <button id="menuToggle" class="flex flex-col justify-between w-6 h-4 focus:outline-none">
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
          <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      </button>

      <!-- Dropdown Menu -->
      <div id="dropdownMenu"
           class="hidden absolute top-14 right-0 bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
          
          <!-- Profil -->
          <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
              <img src="{{ asset('images/Vector profil.png') }}" class="w-5 h-5 mr-3">
              Profil
          </a>

          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
                  <img src="{{ asset('images/Vector logout.png') }}" class="w-5 h-5 mr-3">
                  Logout
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

// Klik di luar menu untuk nutup
document.addEventListener('click', (e) => {
    if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
</script>

  <style>
    body {
      background-color: #faf3e0;
      font-family: 'Inter', sans-serif;
    }

    .flashcard-section {
      background-color: #fffaf2;
      border-radius: 20px;
      padding: 40px;
      width: 90%;
      margin: 50px auto;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      font-family: 'Maragsa', serif;
      font-weight: 700;
      font-size: 56px;
      color: #3c2a1e;
      text-align: center;
      margin-bottom: 30px;
    }

    /* Grid 4x3 */
    .flashcard-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
      justify-items: center;
    }

    .card-flip {
      width: 180px;
      height: 240px;
      perspective: 1000px;
      cursor: pointer;
    }

    .card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.7s;
      transform-style: preserve-3d;
    }

    .card-flip.flipped .card-inner {
      transform: rotateY(180deg);
    }

    .card-front, .card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: 700;
      border-radius: 10px;
      color: #000;
      background-image: url('/images/flashcard.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .card-back {
      transform: rotateY(180deg);
      color: #4a2d00;
    }

    /* Popup selesai */
    .complete-popup {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 1000;
      animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .popup-content {
      position: relative;
      background: #fff;
      border-radius: 15px;
      padding: 40px 50px 60px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.25);
      width: 480px;
      text-align: left;
      overflow: visible;
      animation: zoomIn 0.4s ease;
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .popup-content h4 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: #3c2a1e;
      margin-bottom: 10px;
    }

    .popup-content p {
      color: #333;
      margin-bottom: 20px;
    }

    .popup-content img {
      position: absolute;
      bottom: -5px;
      left: -60px;
      width: 140px;
      height: auto;
    }

    .popup-content button {
      position: absolute;
      bottom: 20px;
      right: 30px;
      background-color: #4b8673;
      color: white;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      font-size: 14px;
      transition: background 0.2s;
    }

    .popup-content button:hover {
      background-color: #3a6b5a;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .flashcard-container {
        grid-template-columns: repeat(2, 1fr);
      }

      .popup-content {
        width: 90%;
        padding: 30px 20px 50px;
      }

      .popup-content img {
        width: 100px;
        left: -30px;
      }

      .popup-content button {
        bottom: 15px;
        right: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="flashcard-section">
    <h2> Materi {{ $modulId }}</h2>

    <div class="flashcard-container">
      @foreach ($flashcards->take(12) as $f)
        <div class="card-flip" onclick="flipCard(this)">
          <div class="card-inner">
            <div class="card-front">{{ strtoupper($f->kata_indo) }}</div>
            <div class="card-back">{{ strtoupper($f->kata_jawa) }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Popup selesai -->
  <div class="complete-popup" id="completePopup">
    <div class="popup-content">
      <img src="/images/pop up selesai.png" alt="Karakter Jawa">
      <h4>Hebat!</h4>
      <p>Semua flashcard sudah kamu selesaikan!</p>
      <button onclick="goBack()">Kembali</button>
    </div>
  </div>

  <script>
    let flippedCount = 0;
    const totalCards = 12;

    function flipCard(card) {
      if (!card.classList.contains('flipped')) {
        card.classList.add('flipped');
        flippedCount++;
      }
      if (flippedCount === totalCards) {
        document.getElementById('completePopup').style.display = 'flex';
      }
    }

    function goBack() {
      window.location.href = '/dashboard-user';
    }
  </script>

</body>
</html>