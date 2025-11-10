<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjakan Kuis</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #fdf6ee;
        margin: 0;
        padding: 0;
        color: #3b2f2f;
        position: relative;
    }

    /* Awan kiri */
    .cloud-left {
        position: absolute;
        bottom: 200px;
        left: 0;
        width: 240px;
        opacity: 0.85;
        pointer-events: none;
    }

    /* Awan kanan (lebih tinggi) */
    .cloud-right {
        position: absolute;
        bottom: 100px;
        right: 0;
        width: 230px;
        opacity: 0.9;
        pointer-events: none;
    }

    header {
        background-color: white;
        padding: 15px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        position: relative;
        z-index: 10;
    }
    header h1 {
        font-weight: 700;
        font-size: 22px;
        color: #622F10;
        margin: 0;
        font-family: 'Playfair Display', serif;
    }
    .logout-btn {
        background-color: #ff9f57;
        border: none;
        padding: 8px 18px;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .quiz-container {
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        padding: 40px 70px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        position: relative;
        z-index: 10;
    }
    .quiz-title {
        font-size: 15px;
        font-weight: 600;
        color: #9a6a4f;
    }
    .quiz-number {
        font-size: 22px;
        font-weight: 700;
        margin-top: 5px;
        color: #3b2f2f;
    }
    .question-text {
        font-size: 17px;
        margin-top: 20px;
        margin-bottom: 30px;
        line-height: 1.6;
    }
.option-box {
    display: flex;            /* sejajarkan radio button dan teks */
    align-items: center;      /* vertikal center */
    gap: 12px;                /* jarak radio button ke teks */
    width: calc(100% - 10px); /* biar ada jarak kiri-kanan */
    background: #ffffff;
    border: 1px solid #e3d5c7;
    padding: 12px 20px;       /* padding horizontal lebih lega */
    border-radius: 10px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: 0.2s ease;
    box-sizing: border-box;   /* padding dihitung di lebar kotak */
}
    .option-box:hover {
        border-color: #c99a75;
        background: #fff8f1;
    }
    .option-box input {
        margin-right: 10px;
    }
    .submit-btn {
        margin-top: 25px;
        background-color: #8D6C59;
        border: none;
        color: white;
        padding: 12px 20px;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
    }
</style>

<header>
    <h1 class="font-jawara">JAWARA</h1>
    <form action="{{ url('/dashboard-user') }}" method="GET">
        <button type="submit" class="logout-btn">Keluar</button>
    </form>
</header>

<div class="quiz-container">
    <div class="quiz-title">Pertanyaan</div>
    <div class="quiz-number">{{ sprintf('%02d', $current) }}/{{ $total }}</div>

    <div class="question-text">{!! nl2br(e($question->pertanyaan)) !!}</div>

    <form action="{{ route('kuis.answer', $id_modul) }}" method="POST">
        @csrf

        <label class="option-box">
            <input type="radio" name="jawaban" value="A" required>
            {{ $question->pilihan_a }}
        </label>

        <label class="option-box">
            <input type="radio" name="jawaban" value="B" required>
            {{ $question->pilihan_b }}
        </label>

        <label class="option-box">
            <input type="radio" name="jawaban" value="C" required>
            {{ $question->pilihan_c }}
        </label>

        <label class="option-box">
            <input type="radio" name="jawaban" value="D" required>
            {{ $question->pilihan_d }}
        </label>

        <button type="submit" class="submit-btn">Jawab & Lanjut</button>
    </form>
</div>

<!-- Ilustrasi awan kiri -->
<img src="/images/awan kiri.png" class="cloud-left" alt="awan kiri">

<!-- Ilustrasi awan kanan -->
<img src="/images/awan kanan.png" class="cloud-right" alt="awan kanan">

</body>
</html>