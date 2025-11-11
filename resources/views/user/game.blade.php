<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game User - JAWARA</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maragsa&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background-color: #faf3e0;
      font-family: 'Inter', sans-serif;
    }
    .font-maragsa {
      font-family: 'Maragsa', serif;
      letter-spacing: 0.5px;
      font-weight: 400;
    }

    /* FLASHCARD / MEMORY GAME STYLES */
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
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      color: #000;
    }

    .card-front {
      background-image: url('{{ asset('images/gameCard.png') }}');
      background-size: cover;
      background-position: center;
      color: transparent;
    }

    .card-back {
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
    background-image: url('/images/flashcard.png'); /* gambar flashcard */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transform: rotateY(180deg);
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

    .popup-content button {
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
    }
  </style>
</head>
<body class="relative min-h-screen flex flex-col">

<!-- NAVBAR DASHBOARD USER -->
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] z-20">
  <div class="text-3xl font-maragsa text-[#9A3B1B]">JAWARA</div>

  <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
    <li><a href="#" class="hover:text-[#4C9894]">Home</a></li>
    <li><a href="#" class="hover:text-[#4C9894]">Modul</a></li>
    <li><a href="#" class="hover:text-[#4C9894]">Progress Tracker</a></li>
    <li><a href="{{ route('reflection.list') }}" class="hover:text-[#4C9894]">Riwayat Refleksi</a></li>
  </ul>

  <div class="flex items-center space-x-4 relative">
    <img src="{{ asset('images/profil user.png') }}" alt="User Avatar" class="w-10 h-10 rounded-full object-cover border border-gray-300">
    <button id="menuToggle" class="flex flex-col justify-between w-6 h-4 focus:outline-none">
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
    </button>
    <div id="dropdownMenu" class="hidden absolute top-14 right-0 bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
      <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
        <img src="{{ asset('images/Vector profil.png') }}" class="w-5 h-5 mr-3">Profil
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
          <img src="{{ asset('images/Vector logout.png') }}" class="w-5 h-5 mr-3">Logout
        </button>
      </form>
    </div>
  </div>
</nav>

<script>
const toggleBtn = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');
toggleBtn.addEventListener('click', () => { dropdownMenu.classList.toggle('hidden'); });
document.addEventListener('click', (e) => {
  if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.classList.add('hidden');
  }
});
</script>

<!-- GAME CONTENT -->
<div class="flashcard-section">
  <h2 class="font-maragsa font-bold text-[#3c2a1e] text-[56px] text-center mb-8">Materi {{ $modulId }}</h2>
  <div class="flashcard-container">
    @foreach($cards as $card)
      <div class="card-flip" data-pasangan="{{ $card->pair_id }}" onclick="flipCard(this)">
        <div class="card-inner">
          <div class="card-front"></div>
          <div class="card-back">{{ strtoupper($card->word) }}</div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- POPUP SELESAI -->
<div class="complete-popup" id="completePopup">
  <div class="popup-content">
    <h4>Hebat!</h4>
    <p>Semua pasangan kartu telah ditemukan!</p>
    <button onclick="window.location.href='/dashboard-user'">Kembali</button>
  </div>
</div>

<script>
let firstCard = null;
let secondCard = null;
let lockBoard = false;
let matchedPairs = 0;
const totalPairs = {{ $cards->count() / 2 }};

function flipCard(card) {
  if(lockBoard || card.classList.contains('flipped')) return;
  card.classList.add('flipped');

  if(!firstCard){
    firstCard = card;
  } else {
    secondCard = card;
    checkMatch();
  }
}

function checkMatch(){
  let match = firstCard.dataset.pasangan === secondCard.dataset.pasangan;
  if(match){
    matchedPairs++;
    resetBoard();
    if(matchedPairs === totalPairs){
      document.getElementById('completePopup').style.display = 'flex';
    }
  } else {
    lockBoard = true;
    setTimeout(()=>{
      firstCard.classList.remove('flipped');
      secondCard.classList.remove('flipped');
      resetBoard();
    },1000);
  }
}

function resetBoard(){
  firstCard = null;
  secondCard = null;
  lockBoard = false;
}
</script>

</body>
</html>
