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
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
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

.result-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 40px 60px;
    position: relative;
    z-index: 5;
}

        .result-card {
            background: #ffffff;
            width: 55%;
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }

        .result-title {
            font-size: 18px;
            font-weight: 600;
            color: #8a6a4f;
        }

        .result-score {
            font-size: 110px;
            font-weight: 800;
            color: #622F10;
            margin: 20px 0;
        }

        .retry-btn {
            background-color: #4c9a92;
            border: none;
            padding: 12px 40px;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 15px;
        }

.right-illustration {
    position: absolute;
    right: 0;
    bottom: 0;
    z-index: 1;
    pointer-events: none;
}
.right-illustration img {
    width: 800px;
    max-width: none;
    transform: translateY(130px);
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