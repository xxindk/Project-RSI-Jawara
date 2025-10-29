<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flashcard User - JAWARA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #faf3e0;
      font-family: 'Poppins', sans-serif;
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
      font-family: 'Playfair Display', serif;
      font-weight: 700;
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