<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $kuis->exists ? 'Edit Soal' : 'Tambah Soal' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #FFF7EF;
      color: #4A3B31;
      overflow-x: hidden;
    }

    .font-jawara {
      font-family: 'Playfair Display', serif;
    }

    .logo {
      font-size: 26px;
      font-weight: 800;
      color: #8D6C59;
      text-align: left;
      margin: 30px 0 0 5%;
    }

    .container {
      width: 90%;
      max-width: 900px;
      margin: 40px auto;
      background-color: #8D6C59;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      box-sizing: border-box;
    }

    h2 {
      color: #fff;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 25px;
      text-align: center;
    }

    label {
      color: #FFF7EF;
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
      width: 100%;
      background-color: #FBEFE4;
      border: none;
      border-radius: 6px;
      padding: 10px 12px;
      font-size: 14px;
      color: #4A3B31;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
    }

    input:focus,
    textarea:focus,
    select:focus {
      outline: none;
      box-shadow: 0 0 0 2px #E99561;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    .button-group {
      display: flex;
      justify-content: flex-end;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 25px;
    }

    .btn {
      border: none;
      padding: 10px 24px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      font-size: 14px;
      background-color: #F8A862;
      color: #fff;
      transition: 0.2s;
      text-decoration: none;
      display: inline-block;
    }

    .btn:hover {
      background-color: #e6924d;
    }

    .error-list {
      background-color: #FFDAD6;
      color: #A33B2E;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 20px;
      }
      h2 {
        font-size: 18px;
      }
      .logo {
        margin-left: 20px;
        font-size: 22px;
      }
      .grid-2 {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="logo font-jawara">JAWARA</div>

  <div class="container">
    <h2>{{ $kuis->exists ? 'Edit Soal Kuis' : 'Tambah Soal Kuis' }}</h2>

    @if($errors->any())
      <div class="error-list">
        <ul>
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ $action }}" method="POST">
      @csrf
      @if($method === 'PUT') @method('PUT') @endif

      <div class="form-group">
        <label>Pilih Modul</label>
        <select name="id_modul" required>
          <option value="">-- Pilih Modul --</option>
          @foreach($moduls as $m)
            <option value="{{ $m->id_modul }}" {{ old('id_modul', $kuis->id_modul) == $m->id_modul ? 'selected' : '' }}>
              {{ $m->judul_modul }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Pertanyaan</label>
        <textarea name="pertanyaan" rows="3" required>{{ old('pertanyaan', $kuis->pertanyaan) }}</textarea>
      </div>

      <div class="grid-2">
        <div class="form-group">
          <label>Pilihan A</label>
          <input type="text" name="pilihan_a" value="{{ old('pilihan_a', $kuis->pilihan_a) }}" required>
        </div>
        <div class="form-group">
          <label>Pilihan B</label>
          <input type="text" name="pilihan_b" value="{{ old('pilihan_b', $kuis->pilihan_b) }}" required>
        </div>
        <div class="form-group">
          <label>Pilihan C</label>
          <input type="text" name="pilihan_c" value="{{ old('pilihan_c', $kuis->pilihan_c) }}" required>
        </div>
        <div class="form-group">
          <label>Pilihan D</label>
          <input type="text" name="pilihan_d" value="{{ old('pilihan_d', $kuis->pilihan_d) }}" required>
        </div>
      </div>

      <div class="form-group">
        <label>Jawaban Benar</label>
        <select name="jawaban_benar" required>
          <option value="">-- Pilih Jawaban Benar --</option>
          <option value="A" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'A' ? 'selected' : '' }}>A</option>
          <option value="B" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'B' ? 'selected' : '' }}>B</option>
          <option value="C" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'C' ? 'selected' : '' }}>C</option>
          <option value="D" {{ old('jawaban_benar', $kuis->jawaban_benar) == 'D' ? 'selected' : '' }}>D</option>
        </select>
      </div>

      <div class="form-group">
        <label>Nilai per soal (opsional, default 10)</label>
        <input type="number" name="nilai" value="{{ old('nilai', $kuis->nilai ?? 10) }}" min="0">
      </div>

      <div class="button-group">
        <a href="{{ route('kuis.index') }}" class="btn">Batal</a>
        <button type="submit" class="btn">{{ $kuis->exists ? 'Simpan Perubahan' : 'Simpan' }}</button>
      </div>
    </form>
  </div>
</body>
</html>
