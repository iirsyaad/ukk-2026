@extends ('layouts.app')

@section ('content')
<div class="container">
    <h1>Data kategori</h1>
    <form action="{{ route('kategori.update', ['id_kategori' => $kategori->id_kategori]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="keterangan">keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $kategori->keterangan }}" required>
        </div>

        <div class="form-group">
            <label for="nama_kategori">nama_kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>

        <div class="form-group">
            <label for="kode_kategori">kode_kategori</label>
            <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" value="{{ $kategori->kode_kategori }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
    </form>
</div>
@endsection