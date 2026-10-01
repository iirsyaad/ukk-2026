@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Peminjaman Alat</h2>
    
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="id_user" class="form-label">Pilih User / Peminjam</label>
            <select name="id_user" id="id_user" class="form-control" required>
                <option value="">-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_alat" class="form-label">Pilih Alat</label>
            <select name="id_alat" id="id_alat" class="form-control" required>
                <option value="">-- Pilih Alat --</option>
                @foreach($alat as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_alat }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="1" min="1" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
        </div>

         <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" style="width: 100%;" required>
            <option value="Pending" selected>Pending</option>
            <option value="Disetujui" selected>Disetujui</option>
            <option value="Ditolak" selected>Ditolak</option>
            <option value="Dipinjam" selected>Dipinjam</option>
            <option value="Dikembalikan" selected>Dikembalikan</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="denda" class="form-label fw-semibold">Denda (Rp)</label>
        <input type="number" name="denda" id="denda" class="form-control" value="0" min="0">
    </div>

  <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection