<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'JAWARA')</title>

  {{-- Tailwind & Font --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .font-cinzel { font-family: "Cinzel", serif; }
    .font-poppins { font-family: "Poppins", sans-serif; }
  </style>
</head>

<body class="font-poppins bg-[#FFF9F5] min-h-screen flex flex-col justify-between">

  {{-- Header / Navbar --}}
  @include('layoutcomponents.navbar')

  {{-- Konten Utama --}}
  <main class="flex-grow">
    @yield('content')
  </main>

  {{-- Footer opsional --}}
  @hasSection('footer')
    @yield('footer')
  @endif

</body>
</html>
