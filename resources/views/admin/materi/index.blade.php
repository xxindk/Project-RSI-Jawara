@extends('layouts.admin')

@section('title', 'List Materi')

@section('content')
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h2 {
        color: #000;
        font-size: 20px;
        font-weight: 600;
    }

    .btn-tambah {
        background-color: #E99561;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-tambah:hover {
        background-color: #D27E4E;
    }

    /* ===== TABEL ===== */
    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        table-layout: fixed;
    }

    thead {
        background-color: #F7AD7E;
        color: white;
    }

    th, td {
        text-align: left;
        padding: 10px 12px;
        font-size: 14px;
        border-bottom: 1px solid #f0e0d0;
        vertical-align: middle;
        word-wrap: break-word;
        white-space: normal;
    }

    th {
        font-weight: 600;
    }

    tr:last-child td {
        border-bottom: none;
    }

    /* Potong teks maksimal 3 baris */
    .truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
    }

    .aksi i {
        cursor: pointer;
        margin: 0 6px;
        color: #8D6C59;
        transition: 0.2s;
    }

    .aksi i:hover {
        color: #E99561;
    }

    /* ✅ Lebar kolom disesuaikan tanpa gambar */
    th:nth-child(1) { width: 4%; }   /* No */
    th:nth-child(2) { width: 15%; }  /* Judul */
    th:nth-child(3) { width: 25%; }  /* Deskripsi */
    th:nth-child(4) { width: 10%; }  /* Tingkatan */
    th:nth-child(5) { width: 8%; }   /* Status */
    th:nth-child(6) { width: 38%; }  /* Teks materi */
    th:nth-child(7) { width: 10%; }  /* Aksi */

    @media (max-width: 1366px) {
        th, td {
            font-size: 13px;
            padding: 8px 10px;
        }

        .btn-tambah {
            padding: 6px 12px;
            font-size: 13px;
        }
    }

    @media (max-width: 992px) {
        .table-container { overflow-x: auto; }
        table { min-width: 700px; }
    }
</style>

<div class="header">
    <h2>List Materi</h2>
    <a href="{{ route('materi.create') }}" class="btn-tambah">+ Tambah</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tingkatan Bahasa</th>
                <th>Status</th>
                <th>Teks Materi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materis as $index => $materi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $materi->modul->judul_modul }}</td>
                <td class="truncate-3">{{ $materi->modul->deskripsi ?? '' }}</td>
                <td>{{ $materi->modul->tingkatan_bahasa }}</td>
                <td>{{ $materi->modul->status ? 'Aktif' : 'Nonaktif' }}</td>
                <td class="truncate-3">{{ $materi->konten_teks ?? '' }}</td>
                <td class="aksi">
                    <a href="{{ route('materi.edit', $materi->id_materi) }}">
                        <i class="fa-solid fa-pen" style="color: #FFD700;"></i>
                    </a>

                    <form action="{{ route('materi.destroy', $materi->id_materi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none;border:none;padding:0;">
                            <i class="fa-solid fa-trash" style="color: #FF0000;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#888; padding:20px;">Belum ada data materi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
