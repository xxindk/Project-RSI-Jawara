@extends('layouts.admin')

@section('title', 'List Kuis')

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
        text-decoration: none;
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

    th:nth-child(1) { width: 5%; }
    th:nth-child(2) { width: 20%; }
    th:nth-child(3) { width: 35%; }
    th:nth-child(4) { width: 15%; }
    th:nth-child(5) { width: 15%; }

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
    <h2>List Kuis</h2>
    <a href="{{ route('kuis.create') }}" class="btn-tambah">+ Tambah</a>
</div>

@if(session('success'))
    <div style="margin-bottom: 10px; color: green;">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Modul</th>
                <th>Pertanyaan</th>
                <th>Jawaban Benar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kuis as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->modul->judul_modul ?? '-' }}</td>
                <td class="truncate-3">{{ $k->pertanyaan }}</td>
                <td>{{ $k->jawaban_benar }}</td>
                <td class="aksi">
                    <a href="{{ route('kuis.edit', $k->id_kuis) }}">
                        <i class="fa-solid fa-pen" style="color:#FFD700;"></i>
                    </a>

                    <form action="{{ route('kuis.destroy', $k->id_kuis) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none;border:none;padding:0;">
                            <i class="fa-solid fa-trash" style="color:#FF0000;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#888; padding:20px;">Belum ada data kuis</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:12px;">
    {{ $kuis->links() }}
</div>
@endsection
