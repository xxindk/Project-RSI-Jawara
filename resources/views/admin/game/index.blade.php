<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Memory Cards - Admin JAWARA</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
body { margin:0; font-family:'Poppins', sans-serif; background-color:#FFF7F0; }
.sidebar { width:230px; background-color:#8D6C59; height:100vh; position:fixed; top:0; left:0; color:#fff; display:flex; flex-direction:column; align-items:center; }
.sidebar h1 { margin-top:30px; font-size:22px; font-weight:700; letter-spacing:1px; font-family:'Playfair Display', serif; }
.profile { margin-top:25px; text-align:center; }
.profile img { width:85px; height:85px; border-radius:50%; object-fit:cover; }
.profile h3 { margin:10px 0 3px 0; font-size:15px; font-weight:600; }
.profile small { font-size:12px; color:#E5D3C5; }
.menu { list-style:none; padding:0; margin-top:40px; width:100%; }
.menu li { width:100%; }
.menu a { display:flex; align-items:center; color:#fff; padding:12px 30px; text-decoration:none; font-size:15px; transition:background 0.2s; }
.menu a:hover, .menu a.active { background-color:#A7826B; }
.logout { margin-top:auto; margin-bottom:30px; }
.content { margin-left:230px; padding:40px; min-height:100vh; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; }
.btn-tambah { background-color:#E99561; border:none; color:white; padding:8px 16px; border-radius:6px; cursor:pointer; font-weight:500; transition:0.2s; }
.btn-tambah:hover { background-color:#D27E4E; }
table { width:100%; border-collapse:collapse; background-color:white; border-radius:12px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
thead { background-color:#F7AD7E; color:white; }
th, td { padding:12px 14px; font-size:14px; border-bottom:1px solid #f0e0d0; vertical-align:middle; }
.aksi { display:flex; justify-content:center; align-items:center; gap:10px; }
.aksi i { cursor:pointer; color:#8D6C59; transition:0.2s; font-size:16px; }
.aksi i:hover { color:#E99561; }
</style>
</head>
<body>
<div class="sidebar">
  <h1>JAWARA</h1>
  <div class="profile">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
    @php $admin = Auth::user(); $adminName = $admin ? $admin->nama : 'Admin Jawara'; @endphp
    <h3>{{ $adminName }}</h3>
    <small>Admin</small>
  </div>
  <ul class="menu">
    <li><a href="{{ route('materi.index') }}"><i class="fa-solid fa-book"></i> Materi</a></li>
    <li><a href="{{ route('kuis.index') }}"><i class="fa-solid fa-list-check"></i> Kuis</a></li>
    <li><a href="{{ route('flashcards.index') }}"><i class="fa-solid fa-clone"></i> Flashcard</a></li>
    <li><a href="{{ route('game.index') }}"><i class="fa-solid fa-gamepad"></i> Game</a></li>
  </ul>
     <div class="logout">
      <a href="#" 
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
     style="
        color: white; 
        text-decoration: none; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 15px; 
        width: 100%;
        cursor: pointer;
     ">
    <i class="fa-solid fa-right-from-bracket" style="margin-right:8px;"></i> Logout
  </a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="color:white; text-decoration:none; display:flex; align-items:center; justify-content:center;">
          @csrf
      </form>
      </a>
    </div>
  </div>

<div class="content">
  <div class="header">
    <h2>List Memory Cards</h2>
    <button class="btn-tambah" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th class="text-center">ID Modul</th>
        <th class="text-center">ID Card</th>
        <th>Kata</th>
        <th class="text-center">ID Pasangan</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cards as $index => $c)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td class="text-center">{{ $c->id_modul }}</td>
        <td class="text-center">{{ $c->id_card }}</td>
        <td>{{ $c->word }}</td>
        <td class="text-center">{{ $c->pair_id }}</td>
        <td class="text-center">
          <div class="aksi">
            <i class="fa-solid fa-pen text-warning"
               data-bs-toggle="modal"
               data-bs-target="#editModal"
               data-id_card="{{ $c->id_card }}"
               data-id_modul="{{ $c->id_modul }}"
               data-word="{{ $c->word }}"
               data-pair_id="{{ $c->pair_id }}"></i>

            <form action="{{ route('game.destroy', $c->id_card) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kartu ini?')">
              @csrf @method('DELETE')
              <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                <i class="fa-solid fa-trash text-danger"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('game.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Memory Card</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>ID Modul</label><input type="text" name="id_modul" class="form-control" required></div>
          <div class="mb-3"><label>ID Card</label><input type="text" name="id_card" class="form-control" required></div>
          <div class="mb-3"><label>Kata</label><input type="text" name="word" class="form-control" required></div>
          <div class="mb-3"><label>ID Pasangan</label><input type="text" name="pair_id" class="form-control" required></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success text-white">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Memory Card</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label>ID Modul</label><input type="text" id="edit_id_modul" name="id_modul" class="form-control" required></div>
          <div class="mb-3"><label>ID Card</label><input type="text" id="edit_id_card" name="id_card" class="form-control" readonly></div>
          <div class="mb-3"><label>Kata</label><input type="text" id="edit_word" name="word" class="form-control" required></div>
          <div class="mb-3"><label>ID Pasangan</label><input type="text" id="edit_pair_id" name="pair_id" class="form-control" required></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning text-white">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    document.getElementById('edit_id_modul').value = button.getAttribute('data-id_modul');
    document.getElementById('edit_id_card').value = button.getAttribute('data-id_card');
    document.getElementById('edit_word').value = button.getAttribute('data-word');
    document.getElementById('edit_pair_id').value = button.getAttribute('data-pair_id');
    document.getElementById('editForm').action = '/admin/game/' + button.getAttribute('data-id_card');
});
</script>
</body>
</html>
