<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAWARA | Modul {{ $modul->nomor_urut }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFF7EE;
    }
    .font-jawara {
      font-family: 'Playfair Display', serif;
    }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fdf6ee;
            margin: 0;
            padding: 0;
            color: #3b2f2f;
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
        .banner {
            background: linear-gradient(230deg, #8D6C59 25%, #ffffff 69%, #8D6C59 100%);
            padding: 40px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .banner-left {
            flex: 1;
        }
        .banner h2 {
            color: #622F10;
            font-weight: 700;
            font-size: 20px;
            margin: 0;
        }
        .banner h1 {
            color: #622F10;
            font-size: 28px;
            margin-top: 5px;
        }
        .banner-right img {
            width: 250px;
        }
        .content {
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .section {
            margin-bottom: 30px;
        }
        .section h3 {
            color: #622F10;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .section p {
            color: #333;
            line-height: 1.6;
            font-size: 15px;
            text-align: justify;
        }
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .image-container img {
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

    <div class="banner">
    <div class="banner-left">
        <h2>Modul {{ $modul->nomor_urut }}:</h2>
        <h1>{{ $modul->judul_modul }}</h1>
    </div>
    <div class="banner-right">
        <img src="{{ asset('images/aksara.png') }}" alt="Aksara Jawa">
    </div>
</div>


    <div class="content">
        <div class="section">
            <h3>Deskripsi</h3>
            <p>{!! nl2br(e($modul->deskripsi)) !!}</p>
        </div>

        <hr>

        <div class="section">
            <h3>Materi</h3>
            <p>{!! nl2br(e($materi->konten_teks)) !!}</p>
            @if(!empty($materi->konten_gambar))
            <div class="image-container">
                <img src="{{ asset('storage/' . $materi->konten_gambar) }}" alt="Gambar Materi">
            </div>
            @endif
        </div>
    </div>
</body>
</html>
