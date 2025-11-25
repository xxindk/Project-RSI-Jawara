<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #fdf6ee;
    margin: 0;
    padding: 0;
    color: #3b2f2f;
    position: relative;
}

header {
    background-color: white;
    padding: 1rem 3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
}
header h1 {
    font-weight: 700;
    font-size: clamp(18px, 2.2vw, 28px);
    color: #622F10;
    margin: 0;
    font-family: 'Playfair Display', serif;
}

.logout-btn {
    background-color: #ff9f57;
    border: none;
    padding: 0.5rem 1.2rem;
    color: white;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-size: clamp(12px, 1vw, 16px);
}

/* --- FLEX wrapper --- */
.result-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 3vw 5vw;
    position: relative;
    z-index: 5;
}

/* --- Flexible Card --- */
.result-card {
    background: #ffffff;
    width: 50%;
    padding: clamp(30px, 5vw, 60px);
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    text-align: center;
}

.result-title {
    font-size: clamp(14px, 1.2vw, 20px);
    font-weight: 600;
    color: #8a6a4f;
}

.result-score {
    font-size: clamp(60px, 8vw, 120px);
    font-weight: 800;
    color: #622F10;
    margin: 20px 0;
}

.retry-btn {
    background-color: #4c9a92;
    border: none;
    padding: clamp(10px, 1.5vw, 15px) clamp(25px, 4vw, 40px);
    color: white;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 20px;
    font-size: clamp(14px, 1.3vw, 18px);
}

/* --- Illustration --- */
.right-illustration {
    position: absolute;
    right: 0;
    bottom: 0;
    z-index: 1;
    pointer-events: none;
}
.right-illustration img {
    width: clamp(400px, 40vw, 800px);
    transform: translateY(25vh);
}

/* --- Responsive layout on smaller screens --- */
@media (max-width: 900px) {
    .result-wrapper {
        flex-direction: column;
        text-align: center;
    }
    .result-card {
        width: 90%;
    }
    .right-illustration img {
        position: relative;
        transform: none;
        width: 60vw;
        margin-top: 100px;
    }
}
    </style>
</head>
<body>

<header>
    <h1 class="font-jawara">JAWARA</h1>
    <form action="{{ url('/dashboard-user') }}" method="GET">
        <button type="submit" class="logout-btn">Keluar</button>
    </form>
</header>

<div class="result-wrapper">

    <div class="result-card">
        <div class="result-title">Hasil Kuis</div>
        <div class="result-score">{{ $presentase }}</div>

        @if($presentase < 80)
            <form action="{{ route('kuis.retry', $hasil->id_modul) }}" method="GET">
                <button type="submit" class="retry-btn">Coba Lagi</button>
            </form>
        @else
            <form action="{{ route('kuis.start', $hasil->id_modul) }}" method="GET">
                <button type="submit" class="retry-btn">Coba Lagi</button>
            </form>
        @endif
    </div>

    <div class="right-illustration">
        <img src="/images/tugu.png" alt="Ilustrasi">
    </div>

</div>

</body>
</html>