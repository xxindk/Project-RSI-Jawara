<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Flashcard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #faf3e0; font-family: 'Poppins', sans-serif; }
        .sidebar {
            background-color: #8D6C59;
            min-height: 100vh;
            width: 240px;
            position: fixed;
            padding: 20px;
        }
        .content { margin-left: 260px; padding: 30px; }
        .card-table { background: #fff; border-radius: 16px; padding: 20px; }
        .table thead { background-color: #f0d8b8; }
        .btn-add { background-color: #d8a25e; color: white; border: none; }
        .btn-add:hover { background-color: #b98140; }
        .modal-header { background-color: #f0d8b8; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="fw-bold mb-4">JAWARA</h3>
        <p>Admin Dashboard</p>
    </div>

    <div class="content">
        <h2 class="fw-semibold mb-4">Kelola Flashcard</h2>

        <button class="btn btn-add mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Flashcard</button>

        <div class="card-table shadow-sm">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Modul</th>
                        <th>ID Card</th>
                        <th>Kata Indonesia</th>
                        <th>Kata Jawa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flashcards as $i => $f)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $f->id_modul }}</td>
                        <td>{{ $f->id_card }}</td>
                        <td>{{ $f->kata_indo }}</td>
                        <td>{{ $f->kata_jawa }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="{{ $f->id }}"
                                data-id_modul="{{ $f->id_modul }}"
                                data-id_card="{{ $f->id_card }}"
                                data-kata_indo="{{ $f->kata_indo }}"
                                data-kata_jawa="{{ $f->kata_jawa }}">
                                ✏️
                            </button>

                            <form action="{{ route('flashcards.destroy', $f->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5>Tambah Flashcard</h5></div>
                <div class="modal-body">
                    <form action="{{ route('flashcards.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>ID Modul</label>
                            <input type="number" name="id_modul" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>ID Card</label>
                            <input type="number" name="id_card" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kata Indonesia</label>
                            <input type="text" name="kata_indo" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kata Jawa</label>
                            <input type="text" name="kata_jawa" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-add" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"><h5>Edit Flashcard</h5></div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label>ID Modul</label>
                            <input type="number" id="edit_id_modul" name="id_modul" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>ID Card</label>
                            <input type="number" id="edit_id_card" name="id_card" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kata Indonesia</label>
                            <input type="text" id="edit_kata_indo" name="kata_indo" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kata Jawa</label>
                            <input type="text" id="edit_kata_jawa" name="kata_jawa" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-warning" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const id_modul = button.getAttribute('data-id_modul');
    const id_card = button.getAttribute('data-id_card');
    const kata_indo = button.getAttribute('data-kata_indo');
    const kata_jawa = button.getAttribute('data-kata_jawa');

    document.getElementById('edit_id_modul').value = id_modul;
    document.getElementById('edit_id_card').value = id_card;
    document.getElementById('edit_kata_indo').value = kata_indo;
    document.getElementById('edit_kata_jawa').value = kata_jawa;

    document.getElementById('editForm').action = '/flashcards/' + id;
});
</script>
</body>
</html>
