<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'List Materi') - Admin JAWARA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    h1 {
      font-family: 'Poppins', sans-serif;
    }
    .font-jawara {
      font-family: 'Playfair Display', serif;
    }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #FFF7F0;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 230px;
            background-color: #8D6C59;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h1 {
            margin-top: 30px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .profile {
            margin-top: 25px;
            text-align: center;
        }

        .profile img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile h3 {
            margin: 10px 0 3px 0;
            font-size: 15px;
            font-weight: 600;
        }

        .profile small {
            font-size: 12px;
            color: #E5D3C5;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin-top: 40px;
            width: 100%;
        }

        .menu li {
            width: 100%;
        }

        .menu a {
            display: flex;
            align-items: center;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            font-size: 15px;
            transition: background 0.2s;
        }

        .menu a:hover {
            background-color: #A7826B;
        }

        .menu i {
            margin-right: 10px;
            font-size: 16px;
        }

        .logout {
            margin-top: auto;
            margin-bottom: 30px;
        }

        /* ===== KONTEN ===== */
        .content {
            margin-left: 230px;
            padding: 30px 40px;
            background-color: #FFF7F0;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h1 class="font-jawara">JAWARA</h1>
        <div class="profile">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
            @php
                $admin = Auth::user();
                $adminName = $admin ? $admin->nama : 'Admin Jawara';
            @endphp
            <h3>{{ $adminName }}</h3>
            <small>Admin</small>
        </div>

        <ul class="menu">
            <li><a href="{{ route('materi.index') }}"><i class="fa-solid fa-book"></i> Materi</a></li>
            <li><a href="{{ route('kuis.index') }}"><i class="fa-solid fa-list-check"></i> Kuis</a></li>
            <li><a href="{{ route('flashcards.index') }}"><i class="fa-solid fa-clone"></i> Flashcard</a></li>
            <li><a href="#"><i class="fa-solid fa-gamepad"></i> Game</a></li>
        </ul>

        <div class="logout">
            <a href="{{ route('logout') }}" style="color:white; text-decoration:none; display:flex; align-items:center; justify-content:center;">
                <i class="fa-solid fa-right-from-bracket" style="margin-right:8px;"></i> Logout
            </a>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
