<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flashcard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #faf3e0;
            font-family: 'Poppins', sans-serif;
        }
        .flashcard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .card-flip {
            width: 220px;
            height: 160px;
            perspective: 1000px;
            cursor: pointer;
        }
        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
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
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        .card-front {
            background-color: #f0d8b8;
        }
        .card-back {
            background-color: #d8a25e;
            color: white;
            transform: rotateY(180deg);
        }
        .complete-popup {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
        }
        .popup-content button {
            background: #d8a25e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container text-center mt-5">
        <h2 class="fw-semibold">🎴 Belajar Kosakata Jawa</h2>
        <p>Klik kartu untuk membalik dan lihat terjemahan dalam bahasa Jawa</p>
    </div>

    <div class="flashcard-container">
        @forelse ($flashcards as $f)
            <div class="card-flip" onclick="flipCard(this)">
                <div class="card-inner">
                    <div class="card-front">{{ $f->kata_indo }}</div>
                    <div class="card-back">{{ $f->kata_jawa }}</div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted mt-5">Belum ada flashcard dari admin 😅</p>
        @endforelse
    </div>

    <!-- Popup selesai -->
    <div class="complete-popup" id="completePopup">
        <div class="popup-content">
            <h4>🎉 Selamat!</h4>
            <p>Kamu telah menyelesaikan semua flashcard!</p>
            <button onclick="goBack()">Kembali ke Dashboard</button>
        </div>
    </div>

<script>
let flippedCount = 0;
const totalCards = {{ count($flashcards) }};

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
