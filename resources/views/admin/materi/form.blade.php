<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $materi ? 'Edit Materi' : 'Tambah Materi' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #FFF7EF;
      color: #4A3B31;
      overflow-x: hidden; /* cegah geser kanan */
    }

    h1 {
      font-family: 'Poppins', sans-serif;
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
      width: 90%;              /* biar fleksibel */
      max-width: 900px;        /* batas maksimal agar tidak kepotong */
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
    textarea,
    input[type="file"] {
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
    }

    .btn:hover {
      background-color: #e6924d;
    }

    .preview-img {
      margin-top: 10px;
      border-radius: 8px;
      width: 100px;
      height: auto;
    }

    /* RESPONSIVE */
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
    }
  </style>
</head>
<body>

  <div class="logo font-jawara">JAWARA</div>

  <div class="container">
    <h2>Form Materi</h2>

    <form 
      action="{{ $materi ? route('materi.update', $materi->id_materi) : route('materi.store') }}" 
      method="POST" 
      enctype="multipart/form-data"
    >
      @csrf
      @if($materi)
        @method('PUT')
      @endif

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul_modul" value="{{ old('judul_modul', $materi->modul->judul_modul ?? '') }}" required>
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3">{{ old('deskripsi', $materi->modul->deskripsi ?? '') }}</textarea>
      </div>

      <div class="form-group">
        <label>Nomor Urut</label>
        <input type="number" name="nomor_urut" value="{{ old('nomor_urut', $materi->modul->nomor_urut ?? '') }}" required>
      </div>

      <div class="form-group">
        <label>Tingkatan Bahasa</label>
        <input type="text" name="tingkatan_bahasa" value="{{ old('tingkatan_bahasa', $materi->modul->tingkatan_bahasa ?? '') }}" required>
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status" required>
          <option value="1" {{ old('status', $materi->modul->status ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ old('status', $materi->modul->status ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      <div class="form-group">
        <label>Konten Materi</label>
        <textarea name="konten_teks" rows="4">{{ old('konten_teks', $materi->konten_teks ?? '') }}</textarea>
      </div>

      <div class="form-group">
        <label>Gambar Materi</label>
        <input type="file" name="konten_gambar">
        @if(!empty($materi->konten_gambar))
          <img src="{{ asset('storage/' . $materi->konten_gambar) }}" alt="Gambar Materi" class="preview-img">
        @endif
      </div>

      <div class="button-group">
        <a href="{{ route('materi.index') }}" class="btn btn-batal">Batal</a>
        <button type="submit" class="btn btn-simpan">
          {{ $materi ? 'Simpan Perubahan' : 'Simpan' }}
        </button>
      </div>
    </form>
  </div>
</body>
</html>
