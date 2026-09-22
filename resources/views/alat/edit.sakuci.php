@extends ('layouts.app')

@section ('content')
<div class="container">
    <h1>Tambah Alat</h1>
    <form action="{{ route('alat.update', ['id_alat' => $alat->id_alat]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_alat">nama_alat</label>
            <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="{{ $alat->nama_alat }}" required>
        </div>

        <div class="form-group">
            <label for="kode_alat">kode_alat</label>
            <input type="text" class="form-control" id="kode_alat" name="kode_alat" value="{{ $alat->kode_alat }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
    </form>
</div>
@endsection